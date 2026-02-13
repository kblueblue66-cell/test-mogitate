<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>商品登録-mogitate</title>
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>
<body>
    <header class="header">
        <h1 class="header__logo">mogitate</h1>
    </header>

    <main class="main-container">
        <div class="form-wrapper">
            <h2 class="form-title">商品登録</h2>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" class="register-form">
                @csrf

                <div class="form-group">
                    <label class="form-label">商品名<span class="required">必須</span></label>
                    <input type="text" name="name" class="form-input" placeholder="商品名を入力" value="{{ old('name') }}">
                    @error('name') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">値段<span class="required">必須</span></label>
                    <input type="text" name="price" class="form-input" placeholder="値段を入力" value="{{ old('price') }}">
                    @error('price') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">商品画像<span class="required">必須</span></label>
                    <input type="file" name="image" class="form-input-file">
                    @error('image') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">季節<span class="required">必須</span></label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="seasons[]" value="1"> 春</label>
                        <label><input type="checkbox" name="seasons[]" value="2"> 夏</label>
                        <label><input type="checkbox" name="seasons[]" value="3"> 秋</label>
                        <label><input type="checkbox" name="seasons[]" value="4"> 冬</label>
                    </div>
                    @error('seasons') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">商品説明<span class="required">必須</span></label>
                    <textarea name="description" class="form-textarea" placeholder="商品の説明を入力">{{ old('description') }}</textarea>
                    @error('description') <p class="error-msg">{{ $message }}</p> @enderror
                </div>

                <div class="form-buttons">
                    <a href="{{ route('products.index')}}" class="btn-back">戻る</a>
                    <button type="submit" class="btn-submit">登録</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>