<?php
/**
* Clase con métodos que permiten interactuar con la BD - módulo de Comentarios
* Esta clase abarca las siguientes tablas de la BD:
*     - comentarios
*     - tipos_comentario
*     - usuarios
* En esta clase se encuentran métodos como:
*     - __construct
*     - getRecent
*
* @author Jonathan Jair Alfaro Sánchez
* @link https://github.com/JOMIMAN-Solutions/MEPPP/tree/master/Aplicacion/application/models
* @package application/models
*
* @version 1.0.0
* Creado el 15/06/2018 a las 10:40 am
*
* @since Clase disponible desde la versión 1.0.0
* @deprecated Clase obsoleta en la versión 2.0.0
* @todo Métodos para...
*     - Getters
*     - Setters
*     - Guardar comentarios
*     - Cambiar estatus del comentario para definir si se muestra o no en la pagina de comentarios
*/
class Mdl_Comentario extends CI_Model 
{
    private $_idComentario;
    private $_fechaComentario;
    private $_mensaje;
    private $_estatusComentario;
    private $_tipoComentario;
    private $_usuario;
    
    public function __construct($id = null, $fecha = null, $msj = null, $estatus = null, $tipo = null, $usuario = null) 
    {
        parent::__construct();
        $this->_idComentario = $id;
        $this->_fechaComentario = $fecha;
        $this->_mensaje = $msj;
        $this->_estatusComentario = $estatus;
        $this->_tipoComentario = $tipo;
        $this->_usuario = $usuario;
    }

    /**
    * Metodo que obtiene los 15 comentarios más recientes
    * 
    * @access public
    * @param Ninguno
    * @return array || int
    *
    * @since Método disponible desde la versión 1.0
    * @deprecated Método obsoleto en la versión 2.0
    * @todo Nada
    */
	public function getRecent()
	{
        $condicion = array(
            'tipoComentario' => 'Comentario',
            'estatusComentario' => 1
        );

        $this->db->select('*');
        $this->db->from('comentarios');
        $this->db->join('tipos_comentario', 'idTipoComentario = TiposComentario_idTipoComentario');
        $this->db->join('usuarios', 'idUsuario = Usuarios_idUsuario');
        $this->db->where($condicion);
        $this->db->order_by('fechaComentario', 'DESC');
        $this->db->limit(15);
        $comentarios = $this->db->get();

        /**
        * Condición que determina el dato a retornar
        * Condición que verifica si la consulta anterior trae datos. Si se cumple retorna el arreglo del resultado; si no, retorna 0.
        */
        if ($comentarios->num_rows() != 0) {
            return $comentarios->result();
        } else {
            return 0;
        }
    }
}