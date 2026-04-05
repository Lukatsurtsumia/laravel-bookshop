<div> 
@for ($i = 1; $i <= 5; $i++)
@if($i <= floor($rating))
    ★
@elseif($i - $rating <= 0.5)
    ⯪
@else
    ☆
@endif
@endfor
</div>