<?php

/**
 * A interface for a classes supporting histogram reports.
 */

namespace Joki20\Http\Controllers;

interface HistogramInterface
{
    /**
     * Get the serie.
     *
     * @return array with the serie.
     */
    public function getSerie();
}
