@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

{{--
@section('header_btn')
<form action="{{ route('logout') }}" method="post">
@csrf
<button class="header__logout" type="submit">logout</button>
</form>
@endsection
--}}

@section('content')
<div class="admin">
    <div class="admin__inner">
        <h2 class="admin__title">Admin</h2>

        {{-- 検索フォーム --}}
        <form class="admin-search" action="{{ route('admin.index') }}" method="get">
            <input class="admin-search__input" type="text" name="keyword"
                placeholder="名前やメールアドレスを入力してください" value="{{ $filters['keyword'] }}">

            <select class="admin-search__select" name="gender">
                <option value="">性別</option>
                <option value="1" {{ (string)$filters['gender'] === '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ (string)$filters['gender'] === '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ (string)$filters['gender'] === '3' ? 'selected' : '' }}>その他</option>
            </select>

            {{-- categoriesテーブルのデータから選択 --}}
            <select class="admin-search__select" name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ (string)$filters['category_id'] === (string)$category->id ? 'selected' : '' }}>
                    {{ $category->content }}
                </option>
                @endforeach
            </select>

            <input class="admin-search__date" type="date" name="date" value="{{ $filters['date'] }}">

            <button class="btn btn--brown" type="submit">検索</button>
            <a class="btn btn--gray" href="{{ route('admin.index') }}">リセット</a>
        </form>

        {{-- 上段：エクスポート（左） + ページネーション（右上） --}}
        <div class="admin-table__top">
            <a class="btn btn--outline" href="{{ route('admin.export', request()->query()) }}">エクスポート</a>

            <div class="admin-pagination">
                {{ $contacts->links('pagination.admin') }}
            </div>
        </div>

        {{-- 一覧 --}}
        <div class="admin-table">
            <div class="admin-table__head">
                <div>お名前</div>
                <div>性別</div>
                <div>メールアドレス</div>
                <div>お問い合わせの種類</div>
                <div></div>
            </div>

            @foreach($contacts as $c)
            <div class="admin-table__row">
                <div>{{ $c->last_name }} {{ $c->first_name }}</div>

                {{-- contacts.gender は 1/2/3 想定 --}}
                <div>
                    @if($c->gender == 1) 男性
                    @elseif($c->gender == 2) 女性
                    @else その他
                    @endif
                </div>

                <div>{{ $c->email }}</div>

                {{-- リレーション：Contact belongsTo Category --}}
                <div>{{ optional($c->category)->content }}</div>

                <div class="admin-table__action">
                    <button
                        class="btn btn--detail"
                        type="button"
                        data-open="modal"
                        data-id="{{ $c->id }}"
                        data-name="{{ $c->last_name.' '.$c->first_name }}"
                        data-gender="@if($c->gender==1)男性@elseif($c->gender==2)女性@elseその他@endif"
                        data-email="{{ $c->email }}"
                        data-tel="{{ $c->tel }}"
                        data-address="{{ $c->address }}"
                        data-building="{{ $c->building }}"
                        data-category="{{ optional($c->category)->content }}"
                        data-detail="{{ $c->detail }}">詳細</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- モーダル --}}
<div class="modal" id="modal" aria-hidden="true">
    <div class="modal__overlay" data-close="modal"></div>

    <div class="modal__content">
        <button class="modal__close" type="button" data-close="modal">×</button>

        <div class="modal__grid">
            <div class="modal__label">お名前</div>
            <div class="modal__value" id="m_name"></div>

            <div class="modal__label">性別</div>
            <div class="modal__value" id="m_gender"></div>

            <div class="modal__label">メールアドレス</div>
            <div class="modal__value" id="m_email"></div>

            <div class="modal__label">電話番号</div>
            <div class="modal__value" id="m_tel"></div>

            <div class="modal__label">住所</div>
            <div class="modal__value" id="m_address"></div>

            <div class="modal__label">建物名</div>
            <div class="modal__value" id="m_building"></div>

            <div class="modal__label">お問い合わせの種類</div>
            <div class="modal__value" id="m_category"></div>

            <div class="modal__label">お問い合わせ内容</div>
            <div class="modal__value" id="m_detail"></div>
        </div>

        <div class="modal__footer">
            <form id="deleteForm" method="post" action="">
                @csrf
                @method('DELETE')
                <button class="btn btn--delete" type="submit" onclick="return confirm('削除しますか？')">削除</button>
            </form>
        </div>

    </div>
</div>

<script>
    document.addEventListener('click', (e) => {
        const openBtn = e.target.closest('[data-open="modal"]');
        const closeBtn = e.target.closest('[data-close="modal"]');

        if (openBtn) {
            const modal = document.getElementById('modal');

            document.getElementById('m_name').textContent = openBtn.dataset.name;
            document.getElementById('m_gender').textContent = openBtn.dataset.gender;
            document.getElementById('m_email').textContent = openBtn.dataset.email;
            document.getElementById('m_tel').textContent = (openBtn.dataset.tel || '').replace(/-/g, '');
            document.getElementById('m_address').textContent = openBtn.dataset.address;
            document.getElementById('m_building').textContent = openBtn.dataset.building || '';
            document.getElementById('m_category').textContent = openBtn.dataset.category || '';
            document.getElementById('m_detail').textContent = openBtn.dataset.detail;

            document.getElementById('deleteForm').action = `/admin/${openBtn.dataset.id}`;

            modal.classList.add('is-open');
            modal.setAttribute('aria-hidden', 'false');
        }

        if (closeBtn) {
            const modal = document.getElementById('modal');
            modal.classList.remove('is-open');
            modal.setAttribute('aria-hidden', 'true');
        }
    });
</script>

@endsection