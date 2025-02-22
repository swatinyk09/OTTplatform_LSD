<?php
class SeasonProvider {

    private $con, $username;

    public function __construct($con, $username) {
        $this->con = $con;
        $this->username = $username;
    }

    public function create($entity) {
        $seasons = $entity->getSeasons();

        if(sizeof($seasons) == 0) {
            $seasons = $entity->getMovie();
            $movie = $seasons->getVideos();

            $moviesHtml = "";
            $moviesHtml .= $this->createMovieSquare($movie);

            return "<div class='season'>
                        <div class='videos'>
                             $moviesHtml
                        </div>
                    </div>";
        }

        $seasonsHtml = "";
        foreach($seasons as $season) {
            $seasonNumber =  $season->getSeasonNumber();

         $videosHtml = "";
            foreach($season->getVideos() as $video) {
             $videosHtml .= $this->createVideoSquare($video);
            }

            $seasonsHtml .= "<div class='season'>
                                <h3>Season $seasonNumber</h3>
                                <div class='videos'>
                                 $videosHtml
                                </div>
                            </div>";
        }

        return $seasonsHtml;
    }

    private function createVideoSquare($video) {
        $id = $video->getId();
        $thumbnail = $video->getThumbnail();
        $title = $video->getTitle();
        $description = $video->getDescription();
        $episodeNumber = $video->getEpisodeNumber();

        return "<a href='watch.php?id=$id'>
                    <div class='episodeContainer'>
                        <div class='contents'>
                        
                            <img src='$thumbnail'>
                            
                            <div class='videoInfo'>
                                <h4>$episodeNumber. $title</h4>
                                <span>$description</span>
                            </div>
                            
                        </div>
                    </div>
                </a>";
    }

    private function createMovieSquare($movie) {
        $id = $movie->getId();
        $thumbnail = $movie->getThumbnail();
        $title = $movie->getTitle();
        $description = $movie->getDescription();

        return "<a href='watch.php?id=$id'>
                    <div class='episodeContainer'>
                        <div class='contents'>
                        
                            <img src='$thumbnail'>
                            
                            <div class='videoInfo'>
                                <h4>$title</h4>
                                <span>$description</span>
                            </div>
                            
                        </div>
                    </div>
                </a>";
    }

}
?>