<?php
include './templates/header.php';

// @link https://github.com/workforce-data-initiative/skills-api/wiki/API-Overview
$skillsAPIResponse = file_get_contents( 'http://api.dataatwork.org/v1/jobs' );

if ( $skillsAPIResponse )
{
    $skillsData = json_decode( $skillsAPIResponse );
    if ( $skillsData )
    {
        foreach ( $skillsData as $skill )
        {
            if ( isset($skill->title) )
            {
            ?>
                <li>
                    <?php echo $skill->title; ?>
                </li>
            <?php
            }
          
        }
    }
    else
    {
        echo "ERROR: Unable to convert API response to PHP.";
    }
} 
else
{
    echo "ERROR: Unable to get API response.";
}
?>

<h1>Krisztina's PHP API Practice</h1>



<?php
    include './templates/footer.php';
?>