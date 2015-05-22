RhythmSaga API
==============

The RhythmSaga API is an API which uses multiple sources like last.fm, Spotify, the iTunes API, and a plain simple web search to find the best-quality information for music tracks and artists.

###Usage

The RhythmSaga API is super-simple to use. It accepts both `GET` and `POST` queries through two parameters, `api` and `q`, and returns in plain-text format (except `everything`, which returns JSON.)

The following can be passed through the `api` parameter:
- `search` (returns 6 results)
- `everything`
- `cover`
- `mp3_file`
- `mp3_url`
- `top_charts`
- `youtube_id`
- `track_name`
- `artist_name`
- `album_name`
- `release_date`
- `genre`
- `track_number`

###Examples

####Everything

Fetches everything the API offers in JSON format.

`http://rhythmsa.ga/api.php?api=everything&q=the+beatles+love+me+do`

JSON returned:

`{"track":"Love Me Do","artist":"The Beatles","album":"1","release":"2000-11-13T08:00:00Z","genre":"Rock","trackno":1,"albumart":"http:\/\/rhythmsa.ga\/api\/cover.php?q=Love+Me+Do The Beatles","youtubeid":"Jbt8oH5Lxto","api":"RhythmSaga","apiversion":2,"query":"the beatles love me do"}`

####Album Art

Fetches album artwork in (mostly) 300*300.

`<img src="http://rhythmsa.ga/api.php?api=cover&q=the+beatles+love+me+do">`

####MP3 File

Returns an MP3 file of the song requested. 
Can be used as the `src` of an `<audio>` to make it stream, or as the header of a page for a download link.

`<audio src="http://rhythmsa.ga/api.php?api=mp3_file&q=the+beatles+love+me+do">`

`<?php header("Location: http://rhythmsa.ga/api.php?api=mp3_file&q=the+beatles+love+me+do"); ?>`

####MP3 URL

Returns an MP3 URL of the song requested in plain text. No streaming/downloading.

`http://rhythmsa.ga/api.php?api=mp3_url&q=the+beatles+love+me+do`

####Charts

Returns JSON data from the Billboard Hot 100 list, updated weekly.

`http://rhythmsa.ga/api.php?api=top_charts&q=the+beatles+love+me+do`

####YouTube ID

Returns the ID of the YouTube video of the resulting song in the based on query.

`http://rhythmsa.ga/api.php?api=youtube_id&q=the+beatles+love+me+do` returns `Jbt8oH5Lxto`

####Track Name

Returns the name of the resulting song in the correct format based on query.

`http://rhythmsa.ga/api.php?api=track_name&q=the+beatles+love+me+do` returns `Love Me Do`

####Artist Name

Returns the name of the artist of the resulting song in the correct format based on query.

`http://rhythmsa.ga/api.php?api=artist_name&q=the+beatles+love+me+do` returns `The Beatles`

####Album Name

Returns the name of the album of the resulting song in the correct format based on query.

`http://rhythmsa.ga/api.php?api=album_name&q=the+beatles+love+me+do` returns `1`

####Release Date

Returns the release date of the resulting song in the correct format based on query.

`http://rhythmsa.ga/api.php?api=release_date&q=the+beatles+love+me+do` returns `2000-11-13T08:00:00Z`

####Genre

Returns the primary genre of the resulting song in the correct format based on query.

`http://rhythmsa.ga/api.php?api=genre&q=the+beatles+love+me+do` returns `Rpck`

####Track Number

Returns the track number of the resulting song in the correct format based on query.

`http://rhythmsa.ga/api.php?api=track_number&q=the+beatles+love+me+do` returns `1`
