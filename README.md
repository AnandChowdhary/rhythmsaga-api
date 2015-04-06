RhythmSaga API
==============

The RhythmSaga API is a free API which uses multiple sources like last.fm, Spotify, the iTunes API, and a plain simple web search to find the best-quality information for music tracks and artists.

Album Art
---------

The album art API fetches the artwork using Bing in 300*300.

`<img src="http://rhythmsa.ga/api/cover.php?q=the+beatles+one">`

MP3 API
-------

The MP3 API generated an MP3 URL of the song requested. It can be used as the `src` of an `audio` tag to make it streamble, or as the header of a page for a download link.

`<audio src="http://rhythmsa.ga/api/mp3.php?q=the+beatles+love+me+do">`
