RhythmSaga API
==============

The RhythmSaga API is a free API which uses multiple sources like last.fm, Spotify, the iTunes API, and a plain simple web search to find the best-quality information for music tracks and artists.

Album Art
---------

The album art API fetches the artwork using last.fm network, and if it doesn't find what you need, it further does an image search for the same to bring the best possible album art.

`<img src="http://rhythmsa.ga/api/image?mbid=fdfdb3c0-8820-4c22-94e6-6aa136e36c31">`

Artist (Coming Soon) 
--------------------

a JSON request to URL `http://rhythmsa.ga/api/artist?name=The+Beatles` returns all artist information, including:
- Name (eg. The Beatles)
- Introduction (eg. "The Beatles were an English rock band that formed in Liverpool, in 1960. With John Lennon, Paul McCartney, George Harrison and Ringo Starr, they became widely regarded as the greatest and most influential act of the rock era.")
- Picture (eg. http://sites.psu.edu/blogsbymike/wp-content/uploads/sites/5068/2014/04/1091891-the_beatles_1__jpg_630x464_q85.jpg)

[RhythmSaga](http://rhythmsa.ga)?
===========

In its simplest form, RhythmSaga is like buying music from iTunes. Except you don't pay for it; you download it for free. You can see further top charts, artist information, search for music by track, label, producer, or album, and get beautiful album art.
