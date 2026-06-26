<?php
$index = file_get_contents('resources/views/tienda/index.blade.php');
$topEnd = strpos($index, '<div id="content-wrapper"');
$top = substr($index, 0, $topEnd);
$bottomStart = strpos($index, '</div> <!-- end inner-wrapper -->');
if ($bottomStart === false) {
    // try finding the footer
    $bottomStart = strpos($index, '<footer id="footer"');
    if ($bottomStart === false) {
        $bottomStart = strpos($index, '<footer');
    }
}
$bottom = substr($index, $bottomStart);

$content = $top . '
    <div id="content-wrapper" class="js-content-wrapper container" style="padding-top: 40px; padding-bottom: 80px;">
        <section id="main">
            <div class="archive-description taxonomy-archive-description taxonomy-description" style="text-align: center; margin-bottom: 60px;">
                <h1 class="archive-title" style="font-size: 32px; font-weight: 800; color: #111827; letter-spacing: -0.5px;">Todos los Productos Mirage</h1>
                <hr style="width: 100%; max-width: 600px; margin: 30px auto; border-top: 1px solid #e5e7eb;">
            </div>

            <div class="row">
                @foreach($rootCategories as $category)
                <div class="col-6 col-sm-6 col-md-4 col-lg-3 mb-5" style="text-align: left;">
                    <a href="{{ route(\'tienda.category\', $category->slug) }}" style="text-decoration: none; display: block; color: inherit;">
                        <div class="category-img" style="margin-bottom: 15px; display: flex; align-items: center; justify-content: flex-start;">
                            @if($category->image_url)
                                <img src="{{ $category->image_url }}" alt="{{ $category->name }}" style="max-width: 100%; height: auto; object-fit: contain;">
                            @else
                                <div style="width: 100%; height: 150px; background: #f3f4f6; display: flex; align-items: center; justify-content: center; border-radius: 4px;">
                                    <i class="fa fa-image" style="font-size: 48px; color: #d1d5db;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="category-info">
                            <h2 style="font-size: 16px; font-weight: 700; color: #000; margin: 0; line-height: 1.2;">
                                {{ $category->name }} <span style="font-weight: 700; color: #000;">({{ $category->products_count }})</span>
                            </h2>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </section>
    </div>
' . $bottom;

file_put_contents('resources/views/tienda/catalog_all.blade.php', $content);
echo "View created successfully.\n";
