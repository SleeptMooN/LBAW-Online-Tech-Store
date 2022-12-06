
{{-- start card --}}

<div class="card p-3" >
    <img src="{{ $item->photo }}" class="card-img-top "
        alt="error loading image" onclick="location.href='/product/{{ $item->id }}'" style="cursor: pointer;">
    <div class="card-body" >
        <h5 class="card-title text-center">
            <a href="/product/{{ $item->id }}" class="text-center text-decoration-none text-secondary">
                {{ $item->name }}
            </a>
        </h5>
    </div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item">
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    Price
                </div>
                <div class="d-flex">
                    {{ $item->price }} € 
                </div>
            </div>
        </li>
    </ul>
    <div class="card-body">
        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
            <form action="{{route('card.add')}}" method="POST">
                @csrf
                <input type="hidden" value="{{ $item->id }}" name="id">
                <input type="hidden" value="1" name="quantity">

                <button class="btn btn-dark me-md-4" type="submit"  name="send">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                        <path
                            d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V5z" />
                    </svg>
                </button>
                
                <button class="btn btn-warning" type="submit" name="send" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>

{{-- end card --}}

