<section class="slider">
    <header class="text-center showsearch" >
        <div class="container">
            <div class="header-container">                  
                <div class="header-slider">
                    <?php
                    $Slider = DB::table('slider')->get();
                    ?>
                    @foreach($Slider as $key => $Slide)
                    <?php 
                    $link = $Slide['name'];
                    $hinhanh = $Slide['hinhanh'];
                    $picUrl = asset("storage/app/files/{$hinhanh}");
                    ?>
                    <div class="item">
                        <a href="{{ $link }}" target="_blank item">
                            <img src="{{ $picUrl }}" class="w-100" />
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </header>
</section>