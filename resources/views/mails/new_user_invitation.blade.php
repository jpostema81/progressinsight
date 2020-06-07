@component('mail::message')
# Beste,

Je bent uitgenodigd voor de {{ config('app.name') }} app. 
Door op <a href="{{ $activationLink }}">deze link te klikken</a> word je doorgelinkt naar de pagina waar je je nieuwe gebruikersaccount kunt activeren.

Succes en veel plezier met het gebruik van de {{ config('app.name') }} app!
@endcomponent
