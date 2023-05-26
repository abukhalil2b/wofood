@props(['done_at' => false])

@if($done_at)

<svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#00bfa8">
<g id="SVGRepo_bgCarrier" stroke-width="0"/>
<g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>
<g id="SVGRepo_iconCarrier"> <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#00bfa8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path d="M7.75 12L10.58 14.83L16.25 9.17004" stroke="#00bfa8" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </g>
</svg>

@else

<svg width="25px" height="25px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#cccccc" stroke-width="1.0" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M7.75 12L10.58 14.83L16.25 9.17004" stroke="#cccccc" stroke-width="1.0" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

@endif