<style>
    /* Estilos CSS básicos */
    #karaoke {
        text-align: center;
        color: white;
    }

    #lyrics {
        font-size: 24px;
        margin-bottom: 20px;
        white-space: pre-line;
        /* Para mostrar saltos de línea correctamente */
    }
</style>
<div id="karaoke">
    <h1>Karaoke</h1>
    <div id="lyrics">Let's sing along!</div>
    <audio id="audio" controls>
        <source src="../musica/mp3/Amanece.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <button onclick="togglePlay()">Play/Pause</button>
</div>

<script>
    let lyrics = [{
            time: 0,
            text: "Uah (uah)"
        },
        {
            time: 4.40,
            text: "Siempre te llamo de madrugá Porque quería decirte que (oh-oh)Me encanta todo"
        },
        {
            time: 9.70,
            text: "desde la primera ve’ (oh-oh)Pero esta ve' a mí me tocó perder (uah)"
        },
        {
            time: 14.40,
            text: "No es casualidad, yo lo sé (oh-oh-oh, oh-oh)Te sucede también (oh-oh-oh, oh-oh)Y estás ahí"
        },
        {
            time: 21.10,
            text: "aunque sabes que no es donde perteneces (bebecita)Y tú lo sabes, aunque"
        },
        {
            time: 24.60,
            text: "no lo confieses Quieres volver, con él no te sientes bien (bebé)Si"
        },
        {
            time: 31.00,
            text: "tú no estás las ganas solo crecen (bebé) Quédate en lo que amanece"
        },
        {
            time: 36.20,
            text: "pa' ir rompiéndote to’a (to'a) Y nos olvidamo' de la hora (uah)Yo sé que me"
        },
        {
            time: 42.30,
            text: "prefieres, y quieres (oh-oh)Quédate en lo que amanece pa' ir comiéndote to'a (-o'a)"
        },
        {
            time: 48.50,
            text: "Y encima de mí tú te moja’ (moja-ah)"
        },
        {
            time: 55.50,
            text: "Yo sé que me prefieres, y quieres (bebecita)Quédate"
        },
        {
            time: 59.00,
            text: "en lo que amanece Yo sé que tú tiene’ un novio (novio) Y"
        },
        {
            time: 64.00,
            text: "tú sabe' que yo lo odio (odio) Yo sé que te sientes sola"
        },
        {
            time: 67.90,
            text: "Pero yo te vo’ a morder to'aY yo me enredé en"
        },
        {
            time: 74.00,
            text: "tu piel (uah) Y ya no sé ni qué hacer (uah) Contigo quiero beber"
        },
        {
            time: 81.20,
            text: "Y adentro de ti enloquecer Mi diabla, manipulándome cuando habla (habla)Adentro de ti"
        },
        {
            time: 87.60,
            text: "no quieres que salga (bebé) Y en sexo la noche es larga Uah-uah Pa’ ir rompiéndote"
        },
        {
            time: 93.90,
            text: "to'a (to'a) Y nos olvidamo' de la hora (uah) Yo sé que me prefieres, y quieres (oh-oh, uah)"
        },
        {
            time: 98.60,
            text: "Quédate en lo que amanece pa' ir comiéndote to'a (-o'a)Y encima de"
        },
        {
            time: 110.60,
            text: "mí tú te moja' (moja-ah) Yo sé que me prefieres, y quieres (bebecita) Quédate"
        },
        {
            time: 115.80,
            text: "en lo que amanece Y como Karol G en mi cama (cama)"
        },
        {
            time: 122.70,
            text: "Como Becky G sin pijama (-jama)Ella no sabe amar (uah) Y no se quiere"
        },
        {
            time: 130.10,
            text: "enamorar Y explícale lo que sientes Y dile que tú le mientes"
        },
        {
            time: 136.30,
            text: "Y que yo vivo en tu mente (bebé) Y que te pongo caliente Bandolera,"
        },
        {
            time: 143.30,
            text: "recuerdo la tembla'era (eh-eh, uah) Yo sé que tú me desea' (bebé) Me tiene' en una"
        },
        {
            time: 148.60,
            text: "odisea (uah-uah) Pa' ir rompiéndote to'a (to'a) Y nos olvidamo' de la hora (uah)"
        },
        {
            time: 154.50,
            text: "Yo sé que me prefieres, y quieres (oh-oh, uah) Quédate en lo que amanece"
        },
        {
            time: 187.90,
            text: "pa' ir comiéndote to'a (-o'a) Y encima de mí tú te moja' (moja-ah)Yo sé que"
        },
        {
            time: 189.60,
            text: "me prefieres, y quieres (bebecita) Quédate en lo que amanece Donde se fuma y se hace el amor bien rico, bebecita"
        }
    ];

    let audio = document.getElementById('audio');
    let currentLyricIndex = 0;

    audio.addEventListener('timeupdate', function() {
        let currentTime = audio.currentTime;
        for (let i = 0; i < lyrics.length; i++) {
            if (currentTime >= lyrics[i].time && currentTime < (lyrics[i + 1] ? lyrics[i + 1].time : audio.duration)) {
                document.getElementById('lyrics').innerText = lyrics.map(l => l.text).join('\n'); // Mostrar toda la letra
                document.getElementById('lyrics').innerHTML = document.getElementById('lyrics').innerText.replace(lyrics[i].text, `<span style="color: red;">${lyrics[i].text}</span>`); // Cambiar el color de la línea actual
                currentLyricIndex = i;
                break;
            }
        }
    });

    function togglePlay() {
        if (audio.paused) {
            audio.play();
        } else {
            audio.pause();
        }
    }
</script>