@component('mail::message')
Użytkownik **{{$name}}** prosi o urlop  

@component('mail::button', ['url' => $link])
Zaloguj się aby poznać więcej szczegółów
@endcomponent
Wiadomość wygenerowana automatycznie, nie odpowiadaj!
Administrator
@endcomponent