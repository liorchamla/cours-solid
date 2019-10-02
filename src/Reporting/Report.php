<?php

namespace App\Reporting;

class Report
{
    /**
     * @var string
     */
    protected $date;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var array
     */
    protected $data;

    /**
     * Constructeur qui reçoit la date et le titre du rapport
     *
     * @param string $date
     * @param string $title
     */
    public function __construct(string $date, string $title, array $data)
    {
        $this->date  = $date;
        $this->title = $title;
        $this->data = $data;
    }

    /**
     * Retourne le rapport formatté en HTML
     *
     * @return string
     */
    public function formatToHTML(): string
    {
        $data = "";

        foreach ($this->data as $value) {
            $data .= "<li>$value</li>";
        }

        return "
            <h2>$this->title</h2>
            <em>Date : $this->date</em>
            <h4>Données : </h4>
            <ul>
                $data
            </ul>
        ";
    }

    /**
     * Retourne le rapport formatté en JSON
     *
     * @return string
     */
    public function formatToJSON(): string
    {
        return json_encode($this->getContents());
    }

    /**
     * Retourne un tableau associatif contenant la date et le titre du rapport
     * Indice : tiens tiens, on pourrait donc récupérer ces données depuis l'extérieur ?
     */
    public function getContents()
    {
        return [
            'date'  => $this->date,
            'title' => $this->title,
            'data' => $this->data
        ];
    }
}
