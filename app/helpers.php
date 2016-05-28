<?php
//@author Bramus Van Damme <bramus@bram.us>
function generatePaginationSequence($curPage, $numPages, $numberOfPagesAtEdges = 1, $numberOfPagesAroundCurrent = 1, $glue = '..', $indicateActive = true) {

    $numItemsInSequence = 1 + ($numberOfPagesAroundCurrent * 2) + ($numberOfPagesAtEdges * 2) + 2;

    $curPage = min($curPage, $numPages);

    if ($numPages <= $numItemsInSequence) {
        $finalSequence = range(1, $numPages);
    }

    else {
        $start = ($numberOfPagesAtEdges > 0) ? 1 : $curPage;

        // Parts of the sequence we'll be generating
        $sequence = array(
            'leftEdge' => null,
            'glueLeftCenter' => null,
            'centerPiece' => null,
            'glueCenterRight' => null,
            'rightEdge' => null
        );
        if ($curPage < ($numItemsInSequence/2)) {
            $sequence['leftEdge'] = range(1, ceil($numItemsInSequence/2) + $numberOfPagesAroundCurrent);
            $sequence['centerPiece'] = array($glue);
            if ($numberOfPagesAtEdges > 0) $sequence['rightEdge'] = range($numPages-($numberOfPagesAtEdges-1), $numPages);
        }
        else if ($curPage > $numPages - ($numItemsInSequence/2)) {
            if ($numberOfPagesAtEdges > 0) $sequence['leftEdge'] = range($start, $numberOfPagesAtEdges);
            $sequence['centerPiece'] = array($glue);
            $sequence['rightEdge'] = range(min($numPages - floor($numItemsInSequence/2) - $numberOfPagesAroundCurrent, $curPage - $numberOfPagesAroundCurrent), $numPages);
        }
        else {
            $sequence['centerPiece'] = range($curPage - $numberOfPagesAroundCurrent, $curPage + $numberOfPagesAroundCurrent);

            if ($numberOfPagesAtEdges > 0) $sequence['leftEdge'] = range($start,$numberOfPagesAtEdges);
            if ($numberOfPagesAtEdges > 0) $sequence['rightEdge'] = range($numPages-($numberOfPagesAtEdges-1), $numPages);

            $sequence['glueLeftCenter'] = ($sequence['centerPiece'][0] == ($numberOfPagesAtEdges+2)) ? array($numberOfPagesAtEdges+1) : array($glue);
            $sequence['glueCenterRight'] = array($glue);

        }

        $finalSequence = array();
        foreach($sequence as $k => $v) {
            if ($v !== null) {
                $finalSequence = array_merge($finalSequence, $v);
            }
        }
    }

    if ($indicateActive) {
        return array_replace($finalSequence, array(array_search($curPage, $finalSequence) => '[' . $curPage. ']'));
    } else {
        return $finalSequence;
    }
}