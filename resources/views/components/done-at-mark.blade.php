@props(['done_at' => false])

@if($done_at)

<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" width="25px" height="25px" fill-rule="nonzero">
    <g fill="#477700" fill-rule="nonzero" stroke="#477700" stroke-width="1" stroke-linecap="butt" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
        <path transform="scale(5.33333,5.33333)" d="M36,42h-24c-3.314,0 -6,-2.686 -6,-6v-24c0,-3.314 2.686,-6 6,-6h24c3.314,0 6,2.686 6,6v24c0,3.314 -2.686,6 -6,6z" id="strokeMainSVG"></path>
    </g>
    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
        <g transform="scale(5.33333,5.33333)">
            <path d="M36,42h-24c-3.314,0 -6,-2.686 -6,-6v-24c0,-3.314 2.686,-6 6,-6h24c3.314,0 6,2.686 6,6v24c0,3.314 -2.686,6 -6,6z" fill="#c8e6c9"></path>
            <path d="M34.585,14.586l-13.571,13.586l-5.601,-5.588l-2.826,2.832l8.432,8.412l16.396,-16.414z" fill="#4caf50"></path>
        </g>
    </g>
</svg>

@else

<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0,0,256,256" width="25px" height="25px" fill-rule="nonzero">
    <g transform="">
        <g fill="#dfdfdf" fill-rule="nonzero" stroke="#dfdfdf" stroke-width="1" stroke-linecap="butt" stroke-linejoin="round" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
            <path transform="scale(5.33333,5.33333)" d="M36,42h-24c-3.314,0 -6,-2.686 -6,-6v-24c0,-3.314 2.686,-6 6,-6h24c3.314,0 6,2.686 6,6v24c0,3.314 -2.686,6 -6,6z" id="strokeMainSVG"></path>
        </g>
        <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
            
        </g>
    </g>
</svg>

@endif