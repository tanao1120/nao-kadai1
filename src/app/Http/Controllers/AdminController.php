<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $filters = [
            'keyword'    => trim((string) $request->query('keyword', '')),
            'gender'     => trim((string) $request->query('gender', '')),
            'category_id' => trim((string) $request->query('category_id', '')),
            'date'       => trim((string) $request->query('date', '')),
        ];

        $categories = Category::orderBy('id')->get();

        $query = Contact::query()->with('category');

        // キーワード（姓/名/フルネーム/メール）
        if ($filters['keyword'] !== '') {
            $kw = $filters['keyword'];
            $query->where(function ($q) use ($kw) {
                $q->where('last_name', 'like', "%{$kw}%")
                    ->orWhere('first_name', 'like', "%{$kw}%")
                    ->orWhere('email', 'like', "%{$kw}%")
                    ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$kw}%"])
                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$kw}%"]);
            });
        }

        // 性別
        if ($filters['gender'] !== '') {
            $query->where('gender', (int) $filters['gender']);
        }

        // カテゴリ
        if ($filters['category_id'] !== '') {
            $query->where('category_id', (int) $filters['category_id']);
        }

        // 日付（created_at の日付一致）
        if ($filters['date'] !== '') {
            $query->whereDate('created_at', $filters['date']);
        }

        $contacts = $query->orderByDesc('created_at')
            ->paginate(7)
            ->appends($request->query());

        return view('admin', compact('contacts', 'filters', 'categories'));
    }

    /**
     */
    public function export(Request $request)
    {
        $filters = [
            'keyword'    => trim((string) $request->query('keyword', '')),
            'gender'     => trim((string) $request->query('gender', '')),
            'category_id' => trim((string) $request->query('category_id', '')),
            'date'       => trim((string) $request->query('date', '')),
        ];

        $query = Contact::query()->with('category');

        if ($filters['keyword'] !== '') {
            $kw = $filters['keyword'];
            $query->where(function ($q) use ($kw) {
                $q->where('last_name', 'like', "%{$kw}%")
                    ->orWhere('first_name', 'like', "%{$kw}%")
                    ->orWhere('email', 'like', "%{$kw}%")
                    ->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ["%{$kw}%"])
                    ->orWhereRaw("CONCAT(last_name, ' ', first_name) LIKE ?", ["%{$kw}%"]);
            });
        }

        if ($filters['gender'] !== '') {
            $query->where('gender', (int) $filters['gender']);
        }

        if ($filters['category_id'] !== '') {
            $query->where('category_id', (int) $filters['category_id']);
        }

        if ($filters['date'] !== '') {
            $query->whereDate('created_at', $filters['date']);
        }

        $contacts = $query->orderByDesc('created_at')->get();

        $fileName = 'contacts_' . now()->format('Ymd_His') . '.csv';

        return response()->streamDownload(function () use ($contacts) {
            $out = fopen('php://output', 'w');

            // Excel文字化け対策（UTF-8 BOM）
            fwrite($out, "\xEF\xBB\xBF");

            // ヘッダー
            fputcsv($out, [
                'お名前',
                '性別',
                'メールアドレス',
                '電話番号',
                '住所',
                '建物名',
                'お問い合わせの種類',
                'お問い合わせ内容',
                '作成日',
            ]);

            foreach ($contacts as $c) {
                $genderText = $c->gender == 1 ? '男性' : ($c->gender == 2 ? '女性' : 'その他');

                fputcsv($out, [
                    $c->last_name . ' ' . $c->first_name,
                    $genderText,
                    $c->email,
                    $c->tel,
                    $c->address,
                    $c->building ?? '',
                    optional($c->category)->content ?? '',
                    $c->detail,
                    optional($c->created_at)->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($out);
        }, $fileName, [
            'Content-Type' => 'text/csv; charset=UTF-8',
        ]);
    }

    /**
     * 削除
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()
            ->route('admin.index')
            ->with('message', '削除しました');
    }
}
