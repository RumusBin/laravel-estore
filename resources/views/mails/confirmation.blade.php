<h1>Hello, {{$name}}</h1>
<p>For end your registration please, click the link ....</p>

<a href="{{route('confirmation', $confirm_token)}}">Confirm registration</a>