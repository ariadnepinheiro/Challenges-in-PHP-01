/**
 * Uma rede de sensores espalhados pelo campus mede a temperatura e
 * umidade a cada minuto. Utilizando programação orientada a objetos, 
 * o analista de sistemas projetou as seguintes classes:
 * • Medida: responsável pelos dados medidos do sensor;
 * • Sensor: responsável por capturar os dados medidos e transmiti-los 
 *           ao controlador, e;
 * • Controlador: responsável por receber e reter os dados medidos.
 * 
 * Adicionalmente, deseja-se a implementação do método no controlador
 * obter_media(). Esse método deve receber como parâmetro o sensor e a
 * data, e retornar uma estrutura contendo a temperatura máxima e mínima
 * registrada na data e no sensor informado. Se não houver registro no 
 * sensor na data informada, o método deverá retornar null.


<?php

class Medida
{
//    responsável pelos dados medidos do sensor
    private $temperatura;
    private $data;

    public function __construct($temperatura, $data)
    {
        $this->temperatura = $temperatura;
        $this->data = $data;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getTemperatura()
    {
        return $this->temperatura;
    }

}

class Sensor
{
//    responsável por capturar os dados medidos e transmiti-los ao controlador

    private $nome;
    private $medidas = [];

    public function __construct($nome)
    {
        $this->nome = $nome;
    }

    public function obter_medida($medida)
    {
        $this->medidas[] = $medida;
    }

    public function transmitir($controlador)
    {
        return $controlador->armazena_sensor($this->get_nome(), $this->get_medidas());
    }

    public function get_nome()
    {
        return $this->nome;
    }

    public function get_medidas()
    {
        return $this->medidas;
    }
}

class Controlador
{
//    responsável por receber e reter os dados medidos

    private $nome;
    private $sensores = [];

    public function __construct($nome)
    {
        $this->nome = $nome;
    }

    public function armazena_sensor($nome, $medidas)
    {
        $this->sensores[] = [$nome, $medidas];
    }

    public function obter_media($sensor, $data)
    {
        $sensor_selecionado = [];

        foreach ($this->sensores as $sensor_armazenado) {
            if ($sensor_armazenado[0] = $sensor->get_nome()) {
                $sensor_selecionado = $sensor_armazenado;
            }
        }

        if (empty($sensor_selecionado[0])) {
            return null;
        } else {
            $medidas = $sensor_selecionado[1];
        }

        $minima = 1000;
        $maxima = -1000;

        for ($i = 0; $i < sizeof($medidas); $i++) {
            if ($data == $medidas[$i]->getData()) {
                if ($medidas[$i]->getTemperatura() > $maxima) {
                    $maxima = $medidas[$i]->getTemperatura();
                }
                if ($medidas[$i]->getTemperatura() < $minima) {
                    $minima = $medidas[$i]->getTemperatura();
                }
            }
        }

        if ($minima == 1000 && $maxima == -1000) {
            return null;
        }

        return array("temperatura_mínima" => $minima,
            "temperatura_máxima" => $maxima);
    }
}

$s1 = new Sensor("A00001");
$s1->obter_medida(new Medida(15.0, new DateTime("2021-10-1")));
$s1->obter_medida(new Medida(16.5, new DateTime("2021-10-1")));
$s1->obter_medida(new Medida(18.0, new DateTime("2021-10-1")));
$c1 = new Controlador("C00001");
$s1->transmitir($c1);
print_r($c1->obter_media($s1, new DateTime("2021-10-1")));

?>
