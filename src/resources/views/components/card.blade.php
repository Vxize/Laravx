@props([
    'width' => 'md:w-2/4 lg:w-1/4',
    'pic' => null,
    'picAspect' => 100,
    'title' => '',
    'titleClass' => 'text-2xl my-1 text-center font-bold',
    'description' => '',
    'descriptionClass' => 'text-lg leading-normal mt-2 text-gray-500 text-center',
])
<div class="px-1 py-2 w-full {{ $width }}">
    <div class="border border-solid border-gray-300 rounded-lg shadow-lg h-full flex flex-col">
        @if (isset($pic) && $pic)
            <div class="relative overflow-hidden rounded-t-lg shadow-lg" style="padding-bottom:{{ $picAspect }}%;">
                <img 
                    data-echo="{{ $pic }}"
                    src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mN8Vw8AAmEBb87E6jIAAAAASUVORK5CYII="
                    class="block w-full absolute inset-0 shadow-lg rounded-t-lg"
                >
            </div>
        @endif    
        <div class="p-2 md:px-4 md:pb-4 border-t border-gray-300 flex-grow">
            {{ $title }}
            {{ $description }}
        </div>
        <div class="p-3">
            {{ $slot }}
        </div>
    </div>
</div>
@if (isset($pic) && $pic)
    @once
        @push('scripts')
            <script>
                !function(t,e){"function"==typeof define&&define.amd?define(function(){return e(t)}):"object"==typeof exports?module.exports=e:t.echo=e(t)}(this,function(t){"use strict";var e,n,o,r,c,a={},u=function(){},d=function(t){return null===t.offsetParent},l=function(t,e){if(d(t))return!1;var n=t.getBoundingClientRect();return n.right>=e.l&&n.bottom>=e.t&&n.left<=e.r&&n.top<=e.b},i=function(){(r||!n)&&(clearTimeout(n),n=setTimeout(function(){a.render(),n=null},o))};return a.init=function(n){n=n||{};var d=n.offset||0,l=n.offsetVertical||d,f=n.offsetHorizontal||d,s=function(t,e){return parseInt(t||e,10)};e={t:s(n.offsetTop,l),b:s(n.offsetBottom,l),l:s(n.offsetLeft,f),r:s(n.offsetRight,f)},o=s(n.throttle,250),r=n.debounce!==!1,c=!!n.unload,u=n.callback||u,a.render(),document.addEventListener?(t.addEventListener("scroll",i,!1),t.addEventListener("load",i,!1)):(t.attachEvent("onscroll",i),t.attachEvent("onload",i))},a.render=function(n){for(var o,r,d=(n||document).querySelectorAll("[data-echo], [data-echo-background]"),i=d.length,f={l:0-e.l,t:0-e.t,b:(t.innerHeight||document.documentElement.clientHeight)+e.b,r:(t.innerWidth||document.documentElement.clientWidth)+e.r},s=0;i>s;s++)r=d[s],l(r,f)?(c&&r.setAttribute("data-echo-placeholder",r.src),null!==r.getAttribute("data-echo-background")?r.style.backgroundImage="url("+r.getAttribute("data-echo-background")+")":r.src!==(o=r.getAttribute("data-echo"))&&(r.src=o),c||(r.removeAttribute("data-echo"),r.removeAttribute("data-echo-background")),u(r,"load")):c&&(o=r.getAttribute("data-echo-placeholder"))&&(null!==r.getAttribute("data-echo-background")?r.style.backgroundImage="url("+o+")":r.src=o,r.removeAttribute("data-echo-placeholder"),u(r,"unload"));i||a.detach()},a.detach=function(){document.removeEventListener?t.removeEventListener("scroll",i):t.detachEvent("onscroll",i),clearTimeout(n)},a});
                echo.init({offset:100});
            </script>
        @endpush
    @endonce
@endif