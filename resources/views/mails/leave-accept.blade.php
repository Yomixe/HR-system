@component('mail::message')
Twój kierownik **{{$name}}** zaakceptował Twoją prośbę

@component('mail::button', ['url' => $link])
Zaloguj się aby poznać więcej szczegółów
@endcomponent
Wiadomość wygenerowana automatycznie, nie odpowiadaj!
Administrator
@endcomponent