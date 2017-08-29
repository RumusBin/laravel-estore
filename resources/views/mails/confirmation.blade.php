<h1>Hello, {{$name}}</h1>
<p>For end your registration please, click the link ....</p>

<a href="{{route('confirmation', $confirmToken)}}">Confirm registration</a>