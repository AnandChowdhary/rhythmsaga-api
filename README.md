RhythmSaga API
==============

The RhythmSaga API is an API which uses multiple sources like last.fm, Spotify, the iTunes API, and a plain simple web search to find the best-quality information for music tracks and artists.

####Everything

Fetches everything the API offers in JSON format.

`http://rhythmsa.ga/2/everything.php?q=avril+lavigne+wth`

####Album Art

Fetches album artwork in (mostly) 300*300.

`<img src="http://rhythmsa.ga/api/cover.php?q=avril+lavigne+wth">`

####MP3 File

Returns an MP3 file of the song requested. 
Can be used as the `src` of an `<audio>` to make it stream, or as the header of a page for a download link.

`<audio src="http://rhythmsa.ga/2/mp3_file.php?q=avril+lavigne+wth">`

`<?php header("Location: http://rhythmsa.ga/2/mp3_file.php?q=avril+lavigne+wth"); ?>`

####MP3 URL

Returns an MP3 URL of the song requested in plain text. No streaming/downloading.

`http://rhythmsa.ga/2/mp3_url.php?q=avril+lavigne+wth`

####Charts

Returns JSON data from the Billboard Hot 100 list, updated weekly.

`http://rhythmsa.ga/api/topcharts.php`

####YouTube ID

Returns the ID of the YouTube video of the resulting song in the based on query.

`http://rhythmsa.ga/2/youtube_id.php?q=avril+lavigne+wth` returns `tQmEd_UeeIk`

####Track Name

Returns the name of the resulting song in the correct format based on query.

`http://rhythmsa.ga/2/track_name.php?q=avril+lavigne+wth` returns `What the Hell`

####Artist Name

Returns the name of the artist of the resulting song in the correct format based on query.

`http://rhythmsa.ga/2/artist_name.php?q=avril+lavigne+wth` returns `Avril Lavigne`

####Album Name

Returns the name of the album of the resulting song in the correct format based on query.

`http://rhythmsa.ga/2/album_name.php?q=avril+lavigne+wth` returns `What the Hell - Single`

####Release Date

Returns the release date of the resulting song in the correct format based on query.

`http://rhythmsa.ga/2/release_date.php?q=avril+lavigne+wth` returns `2011-01-07T08:00:00Z`

####Genre

Returns the primary genre of the resulting song in the correct format based on query.

`http://rhythmsa.ga/2/genre.php?q=avril+lavigne+wth` returns `Pop`

####Track Number

Returns the track number of the resulting song in the correct format based on query.

`http://rhythmsa.ga/2/track_number.php?q=avril+lavigne+wth` returns `1`
