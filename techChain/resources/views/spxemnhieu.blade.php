<section id="spgs" class="listsp">
    <h2> SẢN PHẨM XEM NHIỀU</h2>
    <div class="row" id="data">
        @foreach ($spxemnhieu as $sp )
        <div class="sp col-md-3 mt-4">
            <div class="card">
                <img src="{{$sp->hinh}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title"><a href="/sp/{{$sp->id_sp}}" class="nav-link"> {{$sp->ten_sp}}</a></h5>
                    <p class="card-text">{{ number_format( $sp->gia , 0 , "," , ".") }} VNĐ</p>
                    <button class='btn btn-danger'>Chọn</button>
                    <button class="btn btn-primary"> <a href="/sp/{{$sp->id_sp}}" class="nav-link text-bg-primary"> Xem </a> </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

