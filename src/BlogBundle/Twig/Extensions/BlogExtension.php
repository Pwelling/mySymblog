<?php

namespace BlogBundle\Twig\Extensions;

class BlogExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            'created_ago' => new \Twig_Filter_Method($this, 'createdAgo'),
        ];
    }

    /**
     * @param \DateTime $dateTime
     * @return string
     */
    public function createdAgo(\DateTime $dateTime)
    {
        $delta = time() - $dateTime->getTimestamp();
        if ($delta < 0){
            throw new \InvalidArgumentException('createdAgo is unable to handle dates in the future');
        }

        if ($delta < 60) {
            // Seconds
            $time = $delta;
            $duration = $time . ' seconde' . (($time > 1) ? 's' : '') . ' geleden';
        } else if ($delta <= 3600) {
            // Mins
            $time = floor($delta / 60);
            $duration = $time . ' minu' . (($time > 1) ? 'ten' : 'ut') . ' geleden';
        } else if ($delta <= 86400) {
            // Hours
            $time = floor($delta / 3600);
            $duration = $time . ' uur' . (($time > 1) ? '' : '') . ' geleden';
        } else {
            // Days
            $time = floor($delta / 86400);
            $duration = $time . ' dag' . (($time > 1) ? 'en' : '') . ' geleden';
        }
        return $duration;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'blog_extension';
    }
}
