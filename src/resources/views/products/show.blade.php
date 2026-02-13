<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>商品詳細 - mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/show.css') }}">
</head>
<body>
    <header class="header">
        <h1 class="header__logo">mogitate</h1>
    </header>

    <main class="main-container">
        <div class="breadcrumb">
            <a href="{{ route('products.index') }}">商品一覧</a>  {{ $product->name }}
        </div>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="detail-form">
            @csrf
            @method('PATCH')

            <div class="detail-flex-container">
                <div class="detail-left">
                    <div class="image-preview">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="product-img">
                    </div>
                    <div class="form-group">
                        <input type="file" name="image" class="form-input-file">
                        @error('image') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div class="detail-right">
                    <div class="form-group">
                        <label class="form-label">商品名</label>
                        <input type="text" name="name" class="form-input" value="{{ old('name', $product->name) }}">
                        @error('name') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">値段</label>
                        <input type="text" name="price" class="form-input" value="{{ old('price', $product->price) }}">
                        @error('price') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">季節</label>
                        <div class="checkbox-group">
                            @foreach(['春' => 1, '夏' => 2, '秋' => 3, '冬' => 4] as $label => $value)
                                <label>
                                    <input type="checkbox" name="seasons[]" value="{{ $value }}" 
                                    {{ in_array($value, old('seasons', $product->seasons->pluck('id')->toArray() ?? [])) ? 'checked' : '' }}>
                                    {{ $label }}
                                </label>
                            @endforeach
                        </div>
                        @error('seasons') <p class="error-msg">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">商品説明</label>
                <textarea name="description" class="form-textarea">{{ old('description', $product->description) }}</textarea>
                @error('description') <p class="error-msg">{{ $message }}</p> @enderror
            </div>

            <div class="form-buttons">
                <a href="{{ route('products.index') }}" class="btn-back">戻る</a>
                <button type="submit" class="btn-submit">変更を保存</button>
            </div>
        </form>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn-delete" onclick="return confirm('本当に削除しますか？')">
                <span class="icon-trash">🗑</span>
            </button>
        </form>
    </main>
</body>
</html>