<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function showAdmin(Request $request)
    {
        $contacts = Contact::with('category')
            ->keywordSearch($request->all())
            ->paginate(7)
            ->appends($request->query());

        $categories = Category::all();

        $genders = Contact::GENDERS;

        return view('admin', compact('contacts', 'categories', 'genders'));
    }

    public function search(Request $request)
    {
        $form = $request->only(['keyword', 'gender', 'category_id', 'created_at']);

        return redirect()->route('admin.show', $form);
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.show');
    }

    public function export(Request $request)
    {
        $contacts = Contact::with('category')
            ->keywordSearch($request->all())
            ->get();

        $csvHeader = [
            'お名前',
            '性別',
            'メールアドレス',
            '電話番号',
            '住所',
            '建物名',
            'お問い合わせの種類',
            'お問い合わせ内容',
        ];

        $csvData = $contacts->map(function ($contact) {
            return [
                $contact->last_name . ' ' . $contact->first_name,
                $contact->gender_label,
                $contact->email,
                $contact->tel,
                $contact->address,
                $contact->building,
                $contact->category->content ?? '',
                $contact->detail,
            ];
        });

        $filename = 'contacts_export_' . now()->format('Ymd_His') . '.csv';

        $callback = function () use ($csvHeader, $csvData) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $csvHeader);

            foreach ($csvData as $row) {
                fputcsv($file, $row);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, [
            "Content-Type" => "text/csv",
            "Content-Disposition" => "attachment; filename={$filename}",
        ]);
    }
}
