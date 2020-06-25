@component('mail::message')
# Bevestig je registratie

Bedankt voor je registratie. Klik op onderstaande knop om je registratie te bevestigen:

@component('mail::button', ['url' => $activationLink])
Bevestig registratie
@endcomponent

Succes en veel plezier met het gebruik van de {{ config('app.name') }} app!
@endcomponent
