<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CategoriaResource;
use App\Http\Resources\V1\ReservaResource;
use App\Http\Resources\V1\SalaResource;
use App\Models\Categoria;
use App\Models\Finalidade;
use App\Models\Reserva;
use App\Models\Sala;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Retorna as reservas da sala marcadas para o dia corrente.
     * 
     * @param Sala $sala
     * 
     * @return object
     */
    public function getReservasPorSala(Sala $sala) : object {
       $reservas = Reserva::where('sala_id', $sala->id)->where('data', Carbon::now()->format('Y-m-d'))->get();

       return ReservaResource::collection($reservas);
    }

    /**
     * Retorna as reservas com a finalidade marcadas para o dia corrente.
     * 
     * @param Finalidade $finalidade
     * 
     * @return object
     */
    public function getReservasPorFinalidade(Finalidade $finalidade) : object {
       $reservas = Reserva::where('finalidade_id', $finalidade->id)->where('data', Carbon::now()->format('Y-m-d'))->get();

       return ReservaResource::collection($reservas);
    }

    /**
     * Retorna todas as categorias.
     * 
     * @return object
     */
    public function categorias() : object {
        return Categoria::all()->select(['id', 'nome']);
    }
    /**
     * Retorna as informações e salas da categoria.
     * 
     * @param Categoria $categoria
     * 
     * @return object
     */
    public function getCategoria(Categoria $categoria) : object {
        return new CategoriaResource($categoria);
    }

    /**
     * Retorna as informações da sala.
     * 
     * @param Sala $sala
     * 
     * @return object
     */
    public function getSala(Sala $sala) : object {
        return new SalaResource($sala);
    }
}
