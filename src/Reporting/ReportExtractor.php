<?php

namespace App\Reporting;

class ReportExtractor
{

    /**
     * Doit afficher l'ensemble des formats possibles pour un rapport en se servant
     * des formatters ajoutés dans le tableau
     *
     * @param Report $report
     *
     * @return array
     */
    public function process(Report $report): array
    {
        $results = [];

        $results[] = $report->formatToHTML();
        $results[] = $report->formatToJSON();

        return $results;
    }
}
