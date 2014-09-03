RhythmSaga API (Coming Soon)
============================

I'm working on a free music downloading app called [RhythmSaga](http://rhythmsa.ga), which is basically like iTunes. But free. With top charts, artist information, searching by track, label, producer, or album, and beautiful album art.

The RhythmSaga API is a free API which uses multiple sources like last.fm, Spotify, the iTunes API, and a plain simple web search to find the best-quality information for music tracks and artists.

Album Art
---------

The album art API fetches the artwork using last.fm network, and if it doesn't find what you need, it further does an image search for the same to bring the best possible album art.

`<img src="http://rhythmsa.ga/api/image?artist=The+Beatles&song=She+Loves+You">`

Artist 
------

a JSON request to URL `http://rhythmsa.ga/api/artist?name=The+Beatles` returns all artist information, including:
- Name (eg. The Beatles)
- Introduction (eg. "The Beatles were an English rock band that formed in Liverpool, in 1960. With John Lennon, Paul McCartney, George Harrison and Ringo Starr, they became widely regarded as the greatest and most influential act of the rock era.")
- Picture (eg. http://sites.psu.edu/blogsbymike/wp-content/uploads/sites/5068/2014/04/1091891-the_beatles_1__jpg_630x464_q85.jpg)
