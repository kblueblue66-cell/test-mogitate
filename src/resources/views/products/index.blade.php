<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <title>商品一覧 -mogitate</title>
</head>
<body>
    <header class="header">
        <h1 class="header__logo">mogitate</h1>
    </header>

<main>
    <div class="container">
        <aside class="sidebar">
            <h2 class="sidebar__title">商品一覧</h2>
            <form action="{{ route('products.index') }}" method="GET" class="search-form">
                <input type="text" name="keyword" class="search-form__input" placeholder="商品名で検索" value="{{request('keyword')}}">
                <button type="submit" class="search-form__btn">検索</button>

            <div class="sort-section">
                <p class="sort-section__label">価格順で表示</p>
                <div class="sort-section__select-wrapper">
                    <select name="sort" class="sort-section__select" onchange="this.form.submit()">
                        <option value="">価格で並べ替え</option>
                        <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>低い順</option>
                        <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>高い順</option>
                    </select>
                </div>
            </form>
            @if(request('sort'))
                    <div class="filter-tag">
                        <span class="filter-tag__label">
                        {{ request('sort') == 'asc' ? '低い順に表示' : '高い順に表示' }}
                        </span>
                        <a href="{{ request()->fullUrlWithQuery(['sort' => null]) }}" class="filter-tag__close">
                                    ×
                        </a>
                    </div>
            @endif
            </div>
        </aside>

        <section class="product-section">
            <div class="product-section__header">
                <a href="{{ route('products.create') }}" class="add-btn">商品を追加</a>
            </div>

            <div class="product-grid">
                @foreach($products as $product)
                <a href="{{ route('products.show', $product->id) }}" class="product-card">
                    <div class="product-card__img--wrapper">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-card__img">
                    </div>
                    <div class="product-card__info">
                        <span class="product-card__name">{{ $product->name}}</span>
                        <span class="product-card__price">{{ number_format($product->price) }}</span>
                    </div>
                </a>
                @endforeach
            </div>

            <div class="pagination">
                {{ $products->links() }}
            </div>
        </section>
    </div>
</main>
</body>
</html>