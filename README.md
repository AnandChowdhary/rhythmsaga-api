RhythmSaga API
==============

The RhythmSaga API is a free API which uses multiple sources like last.fm, Spotify, the iTunes API, and a plain simple web search to find the best-quality information for music tracks and artists.

Album Art
---------

The album art API fetches the artwork using Bing in 300*300.

`<img src="http://rhythmsa.ga/api/cover.php?q=the+beatles+one">`

MP3 API
-------

The MP3 API generates an MP3 URL of the song requested. It can be used as the `src` of an `audio` tag to make it streamble, or as the header of a page for a download link.

`<audio src="http://rhythmsa.ga/api/mp3.php?q=the+beatles+love+me+do">`
`<?php header("Location: http://rhythmsa.ga/api/mp3.php?q=the+beatles+love+me+do"); ?>`

Charts API
----------

The Charts API returns JSON data from the Billboard Hot 100 list, updated weekly.

`http://rhythmsa.ga/api/topcharts.php`

Sharable API
------------

The Sharable API generates a shortlink using bit.ly of the requested song in text format. The URL takes users to page where a mini-player from Saga can stream the song with links to download it or share it on a social network.

`http://rhythmsa.ga/api/sharable.php?q=the+beatles+love+me+do`
