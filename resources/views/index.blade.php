<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="_token" content="{{ csrf_token() }}" />
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Boka banan | Högelids Tennisklubb</title>
  <meta name="description" content="Nu kan du boka grusbanan i Siene online via vår hemsida!">

  <meta property="og:url"                content="http://www.hogelidstennis.se" />
  {{-- <meta property="og:title"              content="Boka banan | Högelids Tennisklubb" /> --}}
  <meta property="og:description"        content="Nu kan du boka grusbanan i Siene online via vår hemsida!" />
  <meta property="og:image"              content="http://www.hogelidstennis.se/img/hogelidstennis-fb-share.png" />
  <meta property="og:locale"             content="sv_SE" />

  <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
  <link rel="icon" type="image/png" href="/favicon-32x32.png" sizes="32x32">
  <link rel="icon" type="image/png" href="/favicon-16x16.png" sizes="16x16">
  <link rel="manifest" href="/manifest.json">
  <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
  <meta name="theme-color" content="#ffffff">

  <meta name="google-site-verification" content="9-8APSY7uRnwF9fF3_yy4wuL5SsGhJwQPihuuuAtKIc" />

  <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,300italic,400italic,700' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" href="{{ asset('css/main.css') }}">

</head>
<body>
  <div class="bildbox">
    <a href="{{ action('ReservationController@index') }}">
      <img src="{{ asset('img/htk-logo.svg') }}" class="logotype">
    </a>
  </div>

  <h3>Välkommen till <br> Högelids Tennisklubb!</h3>
  <p class="intro-text">Här kan du som är medlem boka speltid på vår grusbana och se andra medlemmars bokade tider.</p>

  <div class="kontaktsektion" style="margin-bottom: 64px;">
    <h2>Högelids Tennisstege 2025</h2>
    <div class="kontaktinfo">
      <p style="margin-top: 4px;">Utmanar du en spelare ovanför dig och vinner? Då tar du deras plats i stegen! Alla nivåer är välkomna och du spelar när det passar dig.</p>
      <p>Om något krånglar går det bra att ringa Wictor på tel. 076 899 54 35.</p>
      <a href="https://forms.gle/UBGZdxFvJ4YKySGe9" target="_blank" class="boka-pike">Gå till anmälan</a>
    </div>
  </div>

  <div class="cta-button">Boka speltid</div>

  <!-- Modal -->
  <div class="reservation-modal" {!! ($errors->any()) ? 'style="display: block;"' : '' !!}>
    <i class="close-btn fa fa-times"></i>
    <p>Fyll i uppgifterna nedan för att boka speltid.
      Avboka speltiden vid förhinder.
      Detta görs genom att trycka på soptunnan under bokade tider.
    </p>

    @if ( $errors->any() )
    <div class="feedback-error">
      @foreach ($errors->all() as $error)
      {{$error}}<br>
      @endforeach
    </div>
    @endif

    <form action="{{ route('reservation.store') }}" method="POST">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <input
        type="text"
        id="date"
        name="start_date"
        class="{{ $errors->has('start_date') ? 'error' : '' }}"
        placeholder="Välj datum"
        value="{{ old('start_date') }}"
      >
      <br>
      <input readonly="true"
        type="text"
        id="start"
        name="start_time"
        class="{{ $errors->has('start_time') ? 'error' : '' }}"
        placeholder="Börja spela kl."
        value="{{ (old('start_time')) ? old('start_time') : '' }}"
      >
      <br>
      <input readonly="true"
        type="text"
        id="stop"
        name="stop_time"
        class="{{ $errors->has('stop_time') ? 'error' : '' }}"
        placeholder="Sluta spela kl."
        value="{{ (old('stop_time')) ? old('stop_time') : '' }}"
      >
      <br>
      <input
        type="text"
        name="name"
        class="{{ $errors->has('name') ? 'error' : '' }}"
        placeholder="Skriv ditt namn"
        value="{{ old('name') }}"
      >
      <br>
      <p style="margin-top: 12px; margin-bottom: -8px; opacity: 0.5;font-style: italic; font-size: 13px;">Har du kollat att tiden är ledig?</p>
      <input type="submit" value="Bekräfta bokning" class="submit-button">
    </form>
  </div>
  
  <div class="bokade-tider">
      <h4>Bokade tider <?php echo date("Y"); ?></h4>
      <div class="hr"></div>
      @if($futureResesrvations->count())
        @foreach($futureResesrvations as $reservation)
          <div class="bokad-tid">
            <p>
              {{ $reservation->start->formatLocalized('%e %b %H:%M') }}
              -
              {{ $reservation->stop->format('H:i') }}
              <strong>{{ $reservation->name }}</strong>
              <i class="fa fa-trash-o tiptool" data-id="{{ $reservation->id }}" aria-hidden="true"></i>
              <div class="test-tip" data-tooltip-id="{{ $reservation->id }}">
                <p>Vill du radera bokning?</p>
                <p class="tip-button close-tip">Nej</p>
                <p data-reservation-id="{{ $reservation->id }}" data-send-ajax="true" class="tip-button">Ja</p>
              </div>
            </p>
            <div class="hr2"></div>
          </div>
        @endforeach
      @endif
      <div class="empty-state" id="empty-state-future-reservations" {!! $futureResesrvations->count() > 0 ? 'style="display:none;"' : '' !!}>
        {{-- Icon made by Papedesign from www.flaticon.com  --}}
        {{-- <img src="{{ asset('img/tennis-ball.svg') }}"> --}}
        <div class="tennis-boll">
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
          	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
          <style type="text/css">
          	.st0{fill:#F1E334;}
          </style>
          <path id="ball" class="st0" d="M279.3,196.6c-0.8-0.8-1.7-1.6-2.6-2.3v0c-33.2-32.1-78.9-48.7-125.2-45.4c0,0,0,0,0,0
          	c-0.1,0-0.2,0-0.4,0c-0.1,0-0.2,0-0.3,0c-35.7,2.6-68.6,16.4-95.1,39.8c-2.9,2.4-5.5,4.9-8.2,7.5C19.9,224,3.1,260.6,0.2,299.4
          	c0,0.1-0.1,0.2-0.1,0.3c0,0.1-0.1,0.3-0.1,0.4c0,0,0,0,0,0s0,0,0,0c0,0,0,0,0,0s0,0,0,0c0,45,12.2,89.7,42.3,122.3
          	c1.6,1.9,3.4,3.7,5,5.4c30.8,30.9,72.4,48,115.6,48c4.1,0,8.1-0.2,12.2-0.5c0,0,0.1,0,0.1,0c39.1-2.7,75.9-19.5,103.5-47.1
          	c2.9-2.9,5.5-5.6,7.4-7.9c23.7-26.7,37.6-59.7,40.3-95.3c0-0.1,0.2-0.2,0.2-0.2c0-0.1,0.2-0.3,0.2-0.4c0,0,0,0,0,0
          	C326.8,276.9,312.9,230.3,279.3,196.6z M62.2,413.1c-1.2-1.2-2.6-2.5-4.1-4.4c-24.5-26.5-37.7-61.7-37.4-97.8
          	c38.1-0.2,74.8,14.7,102,41.9c0.6,0.6,1.3,1.3,1.9,2c0.2,0.2,0.4,0.5,0.6,0.7c25.5,26.7,39.4,62.5,39.1,99.4
          	C126.1,455.3,89.4,440.3,62.2,413.1z M270.2,406.8c-1.7,2.1-3.6,4.2-6.1,6.6c-21.5,21.5-49.2,35.4-79,39.9
          	c-0.1-41.4-16-81.6-44.6-111.8c-1-1.2-2.1-2.3-3.2-3.4c-30.7-30.8-72.1-47.8-115.2-48c4.6-29.7,18.5-57.4,40-78.9
          	c2.2-2.1,4.3-4.2,7-6.4c20.6-18.2,45.4-29.7,72.2-33.8c0,43.1,17,84.6,47.7,115.4c1.3,1.3,2.6,2.6,3.9,3.8
          	c30.1,28.3,70.1,44.1,111.3,44.2C300.3,361.2,288.7,386,270.2,406.8z M207.2,274.8c-1.2-1-2.2-2.1-3.3-3.1
          	c-27.2-27.2-42.1-64.1-41.6-102.2c37.3-0.2,73.4,14.1,100.2,40.2c0.3,0.2,0.5,0.5,0.8,0.7c0.4,0.3,0.7,0.6,1.1,1
          	c27.2,27.2,42.1,64,41.7,102.2C269.6,313.8,234,300,207.2,274.8z"/>
          <g id="lines">
          	<path class="st0" d="M244.4,106.1c2.7,0,5.3-1,7.4-3.1L299,55.8c4.1-4.1,4.1-10.7,0-14.7c-4.1-4.1-10.7-4.1-14.7,0L237,88.3
          		c-4.1,4.1-4.1,10.7,0,14.7C239,105,241.7,106.1,244.4,106.1L244.4,106.1z"/>
          	<path class="st0" d="M289.9,155.9c2,2,4.7,3.1,7.4,3.1c2.7,0,5.3-1,7.4-3.1l53.3-53.3c4.1-4.1,4.1-10.7,0-14.7
          		c-4.1-4.1-10.7-4.1-14.7,0l-53.3,53.3C285.8,145.2,285.8,151.8,289.9,155.9L289.9,155.9z"/>
          	<path class="st0" d="M376.2,80.1c2.7,0,5.3-1,7.4-3.1l23-23c4.1-4.1,4.1-10.7,0-14.7c-4.1-4.1-10.7-4.1-14.7,0l-23,23
          		c-4.1,4.1-4.1,10.7,0,14.7C370.9,79,373.6,80.1,376.2,80.1L376.2,80.1z"/>
          	<path class="st0" d="M508.9,42.9c-4.1-4.1-10.7-4.1-14.7,0L342.9,194.1c-4.1,4.1-4.1,10.7,0,14.7c2,2,4.7,3.1,7.4,3.1
          		c2.7,0,5.3-1,7.4-3.1L508.9,57.6C513,53.5,513,46.9,508.9,42.9z"/>
          </g>
          </svg>
        </div>
        {{-- <p class="bold-text">Banan är ledig!</p>
        <p>Det finns inga bokade tider just nu.</p> --}}
        <p class="bold-text">Säsongsstängt</p>
        <p>Banan har tyvärr inte öppnat än!</p>
      </div>
    </div>
  @if($oldResesrvations->count())
  <div id="pjax-container">
    <div class="bokade-tider">
      <h4>Historik {{ $year != '' ? $year : '' }}</h4>
      @if($historyYears->count() > 1)
          <h5>Välj år att visa</h4>
        <div class="history-button-group">
          @foreach($historyYears as $loopYear)
            <a pjax-link class="button-year {{ $loopYear == $year ? 'active' : '' }}" href="{{ url('/') }}?year={{ $loopYear }}">{{ $loopYear }}</a>
          @endforeach
        </div>
      @endif
      <div class="hr"></div>
      @foreach($oldResesrvations as $reservation)
        <div class="bokad-tid">
          <p>
            {{ $reservation->start->diffForHumans() }}
            {{ $reservation->start->format('H:i') }}
            -
            {{ $reservation->stop->format('H:i') }}
            <strong>{{ $reservation->name }}</strong>
          </p>
          <div class="hr2"></div>
        </div>
      @endforeach
    </div>
  </div><!-- /#pjax-container  -->
  @else
    <div class="bokade-tider">
      <h4>Historik</h4>
      <div class="hr"></div>
      <div class="empty-state">
        {{-- Icon made by Papedesign from www.flaticon.com  --}}
        {{-- <img src="{{ asset('img/tennis-ball.svg') }}"> --}}
        <div class="tennis-boll">
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
          	 viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
          <style type="text/css">
          	.st0{fill:#F1E334;}
          </style>
          <path id="ball" class="st0" d="M279.3,196.6c-0.8-0.8-1.7-1.6-2.6-2.3v0c-33.2-32.1-78.9-48.7-125.2-45.4c0,0,0,0,0,0
          	c-0.1,0-0.2,0-0.4,0c-0.1,0-0.2,0-0.3,0c-35.7,2.6-68.6,16.4-95.1,39.8c-2.9,2.4-5.5,4.9-8.2,7.5C19.9,224,3.1,260.6,0.2,299.4
          	c0,0.1-0.1,0.2-0.1,0.3c0,0.1-0.1,0.3-0.1,0.4c0,0,0,0,0,0s0,0,0,0c0,0,0,0,0,0s0,0,0,0c0,45,12.2,89.7,42.3,122.3
          	c1.6,1.9,3.4,3.7,5,5.4c30.8,30.9,72.4,48,115.6,48c4.1,0,8.1-0.2,12.2-0.5c0,0,0.1,0,0.1,0c39.1-2.7,75.9-19.5,103.5-47.1
          	c2.9-2.9,5.5-5.6,7.4-7.9c23.7-26.7,37.6-59.7,40.3-95.3c0-0.1,0.2-0.2,0.2-0.2c0-0.1,0.2-0.3,0.2-0.4c0,0,0,0,0,0
          	C326.8,276.9,312.9,230.3,279.3,196.6z M62.2,413.1c-1.2-1.2-2.6-2.5-4.1-4.4c-24.5-26.5-37.7-61.7-37.4-97.8
          	c38.1-0.2,74.8,14.7,102,41.9c0.6,0.6,1.3,1.3,1.9,2c0.2,0.2,0.4,0.5,0.6,0.7c25.5,26.7,39.4,62.5,39.1,99.4
          	C126.1,455.3,89.4,440.3,62.2,413.1z M270.2,406.8c-1.7,2.1-3.6,4.2-6.1,6.6c-21.5,21.5-49.2,35.4-79,39.9
          	c-0.1-41.4-16-81.6-44.6-111.8c-1-1.2-2.1-2.3-3.2-3.4c-30.7-30.8-72.1-47.8-115.2-48c4.6-29.7,18.5-57.4,40-78.9
          	c2.2-2.1,4.3-4.2,7-6.4c20.6-18.2,45.4-29.7,72.2-33.8c0,43.1,17,84.6,47.7,115.4c1.3,1.3,2.6,2.6,3.9,3.8
          	c30.1,28.3,70.1,44.1,111.3,44.2C300.3,361.2,288.7,386,270.2,406.8z M207.2,274.8c-1.2-1-2.2-2.1-3.3-3.1
          	c-27.2-27.2-42.1-64.1-41.6-102.2c37.3-0.2,73.4,14.1,100.2,40.2c0.3,0.2,0.5,0.5,0.8,0.7c0.4,0.3,0.7,0.6,1.1,1
          	c27.2,27.2,42.1,64,41.7,102.2C269.6,313.8,234,300,207.2,274.8z"/>
          <g id="lines">
          	<path class="st0" d="M244.4,106.1c2.7,0,5.3-1,7.4-3.1L299,55.8c4.1-4.1,4.1-10.7,0-14.7c-4.1-4.1-10.7-4.1-14.7,0L237,88.3
          		c-4.1,4.1-4.1,10.7,0,14.7C239,105,241.7,106.1,244.4,106.1L244.4,106.1z"/>
          	<path class="st0" d="M289.9,155.9c2,2,4.7,3.1,7.4,3.1c2.7,0,5.3-1,7.4-3.1l53.3-53.3c4.1-4.1,4.1-10.7,0-14.7
          		c-4.1-4.1-10.7-4.1-14.7,0l-53.3,53.3C285.8,145.2,285.8,151.8,289.9,155.9L289.9,155.9z"/>
          	<path class="st0" d="M376.2,80.1c2.7,0,5.3-1,7.4-3.1l23-23c4.1-4.1,4.1-10.7,0-14.7c-4.1-4.1-10.7-4.1-14.7,0l-23,23
          		c-4.1,4.1-4.1,10.7,0,14.7C370.9,79,373.6,80.1,376.2,80.1L376.2,80.1z"/>
          	<path class="st0" d="M508.9,42.9c-4.1-4.1-10.7-4.1-14.7,0L342.9,194.1c-4.1,4.1-4.1,10.7,0,14.7c2,2,4.7,3.1,7.4,3.1
          		c2.7,0,5.3-1,7.4-3.1L508.9,57.6C513,53.5,513,46.9,508.9,42.9z"/>
          </g>
          </svg>
        </div>
        @if($year != date('Y'))
          <p>Det var inte någon drabbning på centercourten {{ $year }}!</p>
        @else
          <p>Det har inte varit någon drabbning på centercourten i år!</p>
        @endif
      </div>
    </div>
  @endif

  {{-- <div class="bokade-tider">
    <img src="{{ asset('img/hogelids-pike.jpg') }}" class="pike">
    <h2>Klubbtröja</h2>
    <div class="kontaktinfo">
      <p style="margin-top: 4px;">Passa på att beställa en pikéskjorta med broderat klubbemblem.</p>
      <p>Kostnad 250kr/pikéskjorta.</p>
      <a href="https://goo.gl/forms/xsw3taXIQXD6F5BX2" target="_blank" class="boka-pike">Beställ klubbtröja</a>
    </div>
  </div> --}}

  {{-- <div class="bokade-tider">
    <h2>Högelids TK Stege 2022</h2>
    <div class="kontaktinfo">
      <p style="margin-top: 2px;">Anmäl dig till Högelids Tennisklubbs stege år 2022. Utmana andra medlemmar i sommar och få chansen att spela mot nya utmanare.</p>
      <h4 style="text-align: left; margin: 16px 0 4px 0;">Så fungerar stegen:</h4>
      <p style="margin-top: 2px;">Man tar kontakt med motspelaren närmast över eller två placeringar upp i tabellen och föreslår en tid. Mer information om var man hittar kontaktuppgifter till motspelare kommer i ett senare skede efter anmälan.</p>
      <p>Den utmanade kan inte neka att ställa upp, men däremot ha synpunkt på matchtid. När ni bestämt en lämplig speltid bokar ni banan. Man kan inte anta en ny utmaning förrän den förra matchen är spelad.</p>
      <p>Vid vinst flyttas utmanaren upp till den utmanades position, som alltså flyttas ned en position tillsammans med samtliga spelare under på stegen. Om den utmanade segrar sker ingenting. </p>
      <h4 style="text-align: left; margin: 24px 0 4px 0;">Anmälan sker online:</h4>
      <p style="margin-top: 2px;">Anmäl dig genom att fylla i namn och e-post. Mer information kommer skickas ut till alla anmälda spelare i ett senare skede. Justering av tabellen kommer också att ske online.</p>
      <p>Om något krånglar går det bra att ringa Wictor på tel. 076 899 54 35.</p>
      <a href="https://forms.gle/UBGZdxFvJ4YKySGe9" target="_blank" class="boka-pike">Gå till anmälan</a>
    </div>
  </div> --}}

  <div class="bokade-tider">
    <h2>Information</h2>
    <div class="kontaktinfo">
      <h4 style="text-align: left; margin: 16px 0 4px 0;">Förhållningsregler</h4>
      <p style="margin-top: 2px;">Vid spel på banan används skor med släta sulor.</p>
      <p>Släpper underlaget lägger vi tillbaka grusmassan och stampar till så att hålor i banan undviks.</p>
      <p>Efter spel skall hela banan sopas av med de breda borstarna och därefter linjerna med linjeborstarna.</p>
      <h4 style="text-align: left; margin: 24px 0 4px 0;">Om Högelids Tennisklubb</h4>
      <p style="margin-top: 2px;">Föreningen, som har sin hemvist i Siene, bildades 1984. Våren 1985 påbörjades arbetet med att anlägga en tennisbana, som invigdes den 10 augusti 1985.</p>
          <p>Klubben började som en andelsförening men några år in på 2000-talet slopade man andelarna och började fritt ta in medlemmar. 2017 hade klubben 61 medlemmar.</p>
          <p>Den egentliga tennisverksamheten, som klubbtävlingar etc, är numera sparsam.
          Man har dock som ambition att hålla tennisbanan i ett så gott skick som möjligt.</p>
    </div>
  </div>

  <div class="kontaktsektion">
    <h2>Kontakt</h2>
    <p class="kontakt-intro">Har du frågor om medlemskap eller andra frågor går det bra att kontakta nedanstående.</p>
    <div class="kontaktinfo">
      <h4>Ordförande:</h4>
      <p>Albin Andreasson: 073 - 646 37 15</p>
      <h4>Banansvarig:</h4>
      <p>Carl Quint: 073 - 096 28 10</p>
    </div>
  </div>

  <div class="footer">
    <a href="https://github.com/wictorstenseke/bokningssystem-HTK" target="_blank"><i class="fa fa-github"></i></a>
    |
    <script type="text/javascript" language="javascript">
    <!--
    // Email obfuscator script 2.1 by Tim Williams, University of Arizona
    // Random encryption key feature by Andrew Moulden, Site Engineering Ltd
    // This code is freeware provided these four comment lines remain intact
    // A wizard to generate this code is at http://www.jottings.com/obfuscator/
    { coded = "T3dHA7.NAPs4ccA4@8ps3o.dAp"
      key = "l9un0wvOcYjS8Vp167aqhMHDkioBe4xTJWd2NRXyQKZ5sbPLgIm3ArCEGUtfFz"
      shift=coded.length
      link=""
      for (i=0; i<coded.length; i++) {
        if (key.indexOf(coded.charAt(i))==-1) {
          ltr = coded.charAt(i)
          link += (ltr)
        }
        else {
          ltr = (key.indexOf(coded.charAt(i))-shift+key.length) % key.length
          link += (key.charAt(ltr))
        }
      }
    document.write("<a href='mailto:"+link+"'>Wictor Stenseke</a>")
    }
    //-->
    </script><noscript>Sorry, you need Javascript on to email me.</noscript>
    |
    <script type="text/javascript" language="javascript">
    <!--
    // Email obfuscator script 2.1 by Tim Williams, University of Arizona
    // Random encryption key feature by Andrew Moulden, Site Engineering Ltd
    // This code is freeware provided these four comment lines remain intact
    // A wizard to generate this code is at http://www.jottings.com/obfuscator/
    { coded = "XAgB61tA.61ldWA@SB1dA.ZgB"
      key = "BS3RQ7YieshzrobxUyVAM4DLq5HP8aCndWctpmgXwT9Iu0K2JjNvOf1Fl6GZEk"
      shift=coded.length
      link=""
      for (i=0; i<coded.length; i++) {
        if (key.indexOf(coded.charAt(i))==-1) {
          ltr = coded.charAt(i)
          link += (ltr)
        }
        else {
          ltr = (key.indexOf(coded.charAt(i))-shift+key.length) % key.length
          link += (key.charAt(ltr))
        }
      }
    document.write("<a href='mailto:"+link+"'>Daniel Blomdahl</a>")
    }
    //-->
    </script><noscript>Sorry, you need Javascript on to email me.</noscript>

  </div>


  <script src="{{ asset('js/jquery-2.2.4.min.js') }}"></script>
  <script src=//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js></script>
  <script src="{{ asset('js/functions.js') }}"></script>
  <script src="{{ asset('js/moment-with-locales.min.js') }}"></script>
  <script src="{{ asset('js/datedropper.js') }}"></script>
  <script src="{{ asset('js/timedropper.js') }}"></script>
  <script src="{{ asset('js/jquery.pjax.js') }}"></script>

  <script>
    @if(Session::has('restoredReservation') && $restoredReservation = Session::get('restoredReservation'))
      $(function(){
        toastr.options = {
          "closeButton": false,
          "debug": false,
          "newestOnTop": false,
          "progressBar": true,
          "positionClass": "toast-top-full-width",
          "preventDuplicates": false,
          "onclick": null,
          "showDuration": "300",
          "hideDuration": "1000",
          "timeOut": "10000",
          "extendedTimeOut": "1000",
          "showEasing": "swing",
          "hideEasing": "linear",
          "showMethod": "fadeIn",
          "hideMethod": "fadeOut"
        }


        toastr.success("<strong>Bokning:</strong>" +
          '{{ $restoredReservation->start->formatLocalized('%e %b %H:%M') }}'
          +'-'+
          '{{ $restoredReservation->stop->format('H:i') }}'
          + ' <strong>Bokad av</strong>: {{ $restoredReservation->name }}'
          , "Återställde bokning")

      })
    @endif
    @if($errors->any())
      $('html, body').animate({
        scrollTop: $(".reservation-modal").offset().top - 10
      }, 400);
    @endif

    $( "#date" ).dateDropper({
      lang: 'sv',
      format: 'Y-m-d',
      lock: 'from',
    });

    var startTimeDropperIsActive = false;
    var stopTimeDropperIsActive = false;

    var startTimeObj = $('[name="start_time"]');
    var stopTimeObj = $('[name="stop_time"]');

    startTimeObj.on('focus, click', function () {
      if(!startTimeDropperIsActive){
        startTimeObj.val('{{ (old('start_time')) ? old('start_time') : defaultStartTime() }}');
        startTimeObj.timeDropper({lang: 'sv', format: 'H:m', minutesInterval: 5});
        startTimeDropperIsActive = true;
        startTimeObj.trigger('click');
      }
    })

    stopTimeObj.on('focus, click', function () {
      if(!stopTimeDropperIsActive){
        if(startTimeDropperIsActive){
          var newTime = moment(startTimeObj.val(), 'HH:mm').add(2, 'hours');
          stopTimeObj.val(newTime.format('HH:mm'))
        }
        else{
          stopTimeObj.val('{{ (old('stop_time')) ? old('stop_time') : defaultStopTime() }}');
        }
        stopTimeObj.timeDropper({lang: 'sv', format: 'H:m', minutesInterval: 5});
        stopTimeDropperIsActive = true;
        stopTimeObj.trigger('click');
      }
    })

    $(document).pjax('a[pjax-link]', '#pjax-container',{
      scrollTo: false
    });

  </script>
</body>
</html>
