<p>Привет, мой друг!</p>
<p> Спешу сообщить, что  </p>
<p> {{$created}} была создана торговая марка:</p>
<p>{{$brandName}}</p>
<p>{{$brandDesc}}</p>
<p>С картинкой: </p>
<body>
<img src="{{ $message->embed($image)}}" >
</body>

