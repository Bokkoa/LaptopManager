<div class="modal fade" id="view-modal">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" align="center"><b>View Request</b></h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <div class="modal-body">
      <form role="form" action="updaterequest" method="post">
        <div class="row">
          <div class="col-md-6">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
          <div class="form-group">
            <label for="modal-input-folio">Folio</label>
            <input type="text" class="form-control" id="modal-input-folio" name="folio" required readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-proyecto">Proyecto</label>
            <input type="text" class="form-control" id="modal-input-proyecto" name="proyecto" required readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-nombreRequisitor">Nombre Requisitor</label>
            <input type="text" class="form-control" id="modal-input-nombreRequisitor" name="nombreRequisitor" required readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-posicion">Posición</label>
            <input type="text" class="form-control" id="modal-input-posicion" name="posicion" required readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-division">División</label>
            <input type="text" class="form-control" id="modal-input-division" name="division" required readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-direccion">Director/Gerente</label>
            <input type="text" class="form-control" id="modal-input-direccion" name="direccion" required readonly>
          </div>
          <div class="form-group">
            <label for="modal-input-problema">Problema</label>
            <textarea type="text" class="form-control" id="modal-input-problema" name="problema" rows="4" required readonly></textarea>
          </div>

          <div class="form-group">
            <label for="modal-input-objetivo">Objetivo</label>
            <!-- <input type="text" class="form-control" id="modal-input-objetivo" name="objetivo" required readonly> -->
            <textarea class="form-control" name="objetivo" id="modal-input-objetivo" rows="4" required readonly></textarea>
          </div>

          <div class="form-group">
            <label for="modal-input-funcionamiento">¿Cómo lo quieres?/¿Cómo Funciona?</label>
            <textarea class="form-control" id="modal-input-funcionamiento" name="funcionamiento" rows="4" required readonly></textarea>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <label for="modal-input-metodologiaActual">¿Cómo se hace actualmente?</label>
            <textarea class="form-control" id="modal-input-metodologiaActual" name="metodologiaActual" rows="4" required readonly></textarea>
          </div>
          <div class="form-group">
            <label for="modal-input-areasImpactadas">Áreas impactadas,¿están de auerdo?</label>
            <textarea class="form-control" id="modal-input-areasImpactadas" name="areasImpactadas" rows="4" required readonly></textarea>
          </div>
          <div class="form-group">
            <label for="modal-input-impactoNegocio">Impacto al negocio</label>
            <textarea class="form-control" id="modal-input-impactoNegocio" name="impactoNegocio" rows="4" required readonly></textarea>
          </div>
          <div class="form-group">
            <label for="modal-input-documentacionAdicional">Procedimiento Relacionado/ ¿Tienes documentación adicional?</label>
            <textarea class="form-control" id="modal-input-documentacionAdicional" name="documentacionAdicional" rows="4" required readonly></textarea>
          </div>
          <div class="form-group">
            <label for="modal-input-uid">UID</label>
            <input type="text" class="form-control" id="modal-input-uid" name="uid" required readonly>
          </div>
          <div class="form-group">
            <!-- <label for="modal-input-estatus">Estatus</label>
            <input type="text" class="form-control" id="modal-input-estatus" name="estatus" required readonly> -->
            <label for="modal-input-estatus">Estatus:</label>
            <select class="form-control" id="modal-input-estatus" name="estatus">
              <option>Abierto</option>
              <option>En Progreso</option>
              <option>Completado</option>
              <option>Cerrado</option>
            </select>
          </div>
          <div class="form-group">
            <label for="modal-input-comentario">Comentarios:</label>
            <textarea class="form-control" id="modal-input-comentario" name="comentario" rows="4" required></textarea>
          </div>
        </div>
      </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
    </form>
</div>
</div>
</div>
</div>

<div class="modal fade" id="delete-modal">
<div class="modal-dialog modal-lg">
<div class="modal-content">
  <div class="modal-header">
    <h4 class="modal-title" align="center"><b>Delete Request</b></h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="modal-body">
    <form role="form" action="deleterequest" method="post">
      <div class="row">
        <div class="col-md-6">

      <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

      <div class="form-group">
        <label for="modal-input-delete-folio">Folio</label>
        <input type="text" class="form-control" id="modal-input-delete-folio" name="folio" required readonly>
      </div>
      <div class="form-group">
        <label for="modal-input-delete-proyecto">Proyecto</label>
        <input type="text" class="form-control" id="modal-input-delete-proyecto" name="proyecto" required readonly>
      </div>
      <div class="form-group">
        <label for="modal-input-delete-nombreRequisitor">Nombre Requisitor</label>
        <input type="text" class="form-control" id="modal-input-delete-nombreRequisitor" name="nombreRequisitor" required readonly>
      </div>
      <div class="form-group">
        <label for="modal-input-delete-posicion">Posición</label>
        <input type="text" class="form-control" id="modal-input-delete-posicion" name="posicion" required readonly>
      </div>
      <div class="form-group">
        <label for="modal-input-delete-division">División</label>
        <input type="text" class="form-control" id="modal-input-delete-division" name="division" required readonly>
      </div>
      <div class="form-group">
        <label for="modal-input-delete-direccion">Director/Gerente</label>
        <input type="text" class="form-control" id="modal-input-delete-direccion" name="direccion" required readonly>
      </div>
      <div class="form-group">
        <label for="modal-input-delete-problema">Problema</label>
        <textarea class="form-control" id="modal-input-delete-problema" name="problema" rows="4" required readonly></textarea>
      </div>

      <div class="form-group">
        <label for="modal-input-delete-objetivo">Objetivo</label>
        <textarea class="form-control" id="modal-input-delete-objetivo" name="objetivo" rows="4" required readonly></textarea>
      </div>

      <div class="form-group">
        <label for="modal-input-delete-funcionamiento">¿Cómo lo quieres?/¿Cómo Funciona?</label>
        <textarea class="form-control" id="modal-input-delete-funcionamiento" name="funcionamiento" rows="4" required readonly></textarea>
      </div>
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <label for="modal-input-delete-metodologiaActual">¿Cómo se hace actualmente?</label>
        <textarea class="form-control" id="modal-input-delete-metodologiaActual" name="metodologiaActual" rows="4" required readonly></textarea>
      </div>
      <div class="form-group">
        <label for="modal-input-delete-areasImpactadas">Áreas impactadas,¿están de auerdo?</label>
        <textarea class="form-control" id="modal-input-delete-areasImpactadas" name="areasImpactadas" rows="4" required readonly></textarea>
      </div>
      <div class="form-group">
        <label for="modal-input-delete-impactoNegocio">Impacto al negocio</label>
        <textarea class="form-control" id="modal-input-delete-impactoNegocio" name="impactoNegocio" rows="4" required readonly></textarea>
      </div>
      <div class="form-group">
        <label for="modal-input-delete-documentacionAdicional">Procedimiento Relacionado/ ¿Tienes documentación adicional?</label>
        <textarea class="form-control" id="modal-input-delete-documentacionAdicional" name="documentacionAdicional" rows="4" required readonly></textarea>
      </div>
      <div class="form-group">
        <label for="modal-input-delete-uid">UID</label>
        <input type="text" class="form-control" id="modal-input-delete-uid" name="uid" required readonly>
      </div>
      <div class="form-group">
        <label for="modal-input-delete-estatus">Estatus</label>
        <input type="text" class="form-control" id="modal-input-delete-estatus" name="estatus" required readonly>
      </div>
    </div>
    </div>
  </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-danger">Delete request</button>
    </div>
    </form>
  </div>
</div>
</div>
</div>
