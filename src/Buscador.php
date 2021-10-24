<?php

namespace Alura\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscador
{
    /**
     * @var ClientInterface
     */
    private ClientInterface $httpClient;
    /**
     * @var Crawler
     */
    private Crawler $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function buscar(string $url): array
    {
        $resposta = $this->httpClient->request('GET', $url);
        $html = $resposta->getBody();
        $this->crawler->addHtmlContent($html);

        $elementosCursos = $this->crawler->filter('span.card-curso__nome');
        $cursos = [];

        foreach ($elementosCursos as $elemento) {
            $cursos[] = $elemento->textContent;
        }

        return $cursos;
    }

    public static function exibeSaudacao(): void
    {
        $horaMinutoAgora = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));
        $horaAgora = intval($horaMinutoAgora->format('H'));
        $nome = "Elias";

        switch ($horaAgora) {
            case ($horaAgora > 6 && $horaAgora <= 11):
                $saudacao = "Bom dia, {$nome}";
                break;
            case ($horaAgora >= 12 && $horaAgora <= 18):
                $saudacao = "Boa Tarde, {$nome}";
                break;
            case ($horaAgora >= 18 && $horaAgora <= 23):
                $saudacao = "Boa Noite, {$nome}";
                break;
            default:
                $saudacao = "Boa Madrugada, $nome";
                break;
        }
        echo $saudacao . PHP_EOL;
    }
}
