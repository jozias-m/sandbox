    let hexColor = "f88f8f";
    let QAutoPlay = true;
    let QnextEp = true;
    let QepSelect = true;

    let tmdbId = 74728;
    let season = 1;
    let episode = 1;

    let source = "https://www.vidking.net";

    function setPlayback() {
        hexColor = "f88f8f";
        QAutoPlay = document.getElementById("QAutoPlay").checked;
        QnextEp = document.getElementById("QnextEp").checked;
        QepSelect = document.getElementById("QepSelect").checked;

        tmdbId = document.getElementById("tmdbId").value;
        season = document.getElementById("season").value;
        episode = document.getElementById("episode").value;

        source  =  source + "/embed/tv";
        source  =  source + "/" + tmdbId;
        source  =  source + "/" + season;
        source  =  source + "/" + episode;
        source = source + "?color=" + hexColor;
        source = source + "?autoPlay=" + QAutoPlay;
        source = source + "?nextEpisode=" + QnextEp;
        source = source + "?episodeSelector=" + QepSelect;
        // source = source + "?progress=0";

        document.getElementById("playerID001").setAttribute("src",source);
        
        alert("Set");
    }
