<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Test</title>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@300&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="main">

            <div class="menu">
                <div class="lheader">
                    <span>Система управления сайтом WW</span>
                </div>
                <div class="lcontent">
                <div class="list">
                    <div>Моя компания</div>
                    <div class="menu_catalog">
                        <div class="main_drop">Каталог
                            <img src="/photo/Arrow_right.svg" class="arrow_down">
                        </div>

                        <div class="drop">Категории</div>
                        <div class="drop">Товары</div>
                    </div>
                    <div class="contacts">Контакты
                        <div></div>
                    </div>
                    <div>SEO-подготовка</div>
                </div>

                    <div class="footer">
                        <div>
                            <span>
                                Техническая поддержка:<br>
                                <img src="/photo/Phone.svg"> тел. +7 (3452) 51-41-55<br>
                                <img src="/photo/Mail.svg"> e-mail: info@ww.net.ru
                            </span>
                        </div>
                        <div>
                        <span>
                                <a href="https://ww.net.ru">Digital Studio <q>WW</q> &copy 2022<br>
                                https://ww.net.ru</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rcontent">
                <div class="rheader">
                    <div class="left_header">
                        <div><img class="to_menu" src="/photo/Menu.svg"></div>
                        <div><img src="/photo/Home.svg"></div>
                        <div><span>Товары</span></div>
                    </div>

                    <div class="right_header">
                        <div><a href="#">Перейти на сайт</a></div>
                        <div class="admin"><span>Admin</span></div>
                        <div class="exit">
                            <img src="/photo/Exit.svg">
                            <span class="exit_word">Выход</span>
                        </div>
                    </div>
                </div>

                <div class="catalog">
                    <div class="tools">
                        <div class="search">
                            <form method="get" action="">
                                <img src="/photo/Search.svg">
                                <input name="query" type="search" size="40" placeholder="Поиск товара по названию или артикулу">
                                @php
                                    $products = \App\Models\Product::all();

                                    $categories =  \App\Models\Category::all();
                                        if (isset($_GET["query"])) {
                                            $query = $_GET["query"];
                                            $products = \App\Models\Product::select('*')->Where('name','like','%' . $query . '%')
                                            ->orWhere('vendor_code','like','%' . $query . '%')
                                            ->get();
                                            if(count($products) == 0) {
                                                echo "По запросу \"" . $query . "\" ничего не найдено.";
                                            }
                                        }
                                        if(isset($_GET["b"])) {
                                                $b=$_GET["b"];
                                                foreach ($categories as $category){
                                                    if($b=='Все'){
                                                        $products = \App\Models\Product::all();
                                                    }
                                                    else{
                                                        $products = DB::table('products')
                                                ->join('product_categories', 'products.id', '=', 'product_categories.product_id')
                                                ->join('categories', 'product_categories.category_id', '=', 'categories.id')
                                                ->select('products.*')
                                                ->where('categories.name','=',$b)
                                                ->get();
                                                    }
                                                }
                                                if(count($products) == 0) {
                                                echo "Нет товаров данной категории.";
                                            }
                                            }
                                @endphp
                            </form>

                        </div>

                        <div class="tools_button">
                            <div><button class="add">Добавить товар</button></div>
                            <div><button class="draft">
                                <img src="/photo/Pen.svg">
                                <span>Черновики</span>
                            </button></div>
                        </div>
                    </div>
                    <div class="categories">
                        <div>Категория</div>
                        <div><form method="get" action=""><input class="b" type="submit" name="b" value="Все"></form></div>
                        @foreach(\App\Models\Category::all() as $category)
                            <div><form method="get" action=""><input class="b" type="submit" name="b" value="{{$category->name}}"></form></div>
                        @endforeach

                    </div>
                    <div class="products">

                        @foreach($products as $product)
                            <div class="product">
                                <div class="photo"><img src="/photo/p1.png"></div>
                                <div class="info">
                                    <div><span class="name">{{$product->name}}</span></div>
                                    @if($product->old_price !=0  )
                                    <div><span class="old_price">{{number_format($product->old_price, 0, ',', ' ')}} &#8381;</span></div>
                                    @endif
                                    <div><span class="price">{{number_format($product->price, 0, ',', ' ')}} &#8381;</span></div>
                                    <div class="red">
                                        <button>
                                            <img src="/photo/C_pen.svg"><span>Редактировать осн. информацию</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="more_info">
                                    @if($product->status == 1)
                                        <div class="status">
                                            <img src="/photo/Eye.svg"><span>Опубликовано</span>
                                        </div>
                                    @else
                                        <div class="status">
                                            <span>Не опубликовано</span>
                                        </div>
                                    @endif
                                    <div><span class="code">Арт. {{$product->vendor_code}}</span></div>
                                        <div class="trash">
                                            <button>
                                                <img src="/photo/Trash.svg"><span>Удалить</span>
                                            </button>
                                        </div>
                                </div>
                                <div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                <div class="f"></div>
                </div>
            </div>
        </div>
    </body>
</html>
