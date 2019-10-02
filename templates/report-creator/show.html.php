<form action="" method="post">
    <div class="alert alert-light">
        <h1 class="alert-title">Créer un rapport !</h1>
        <div class="form-group">
            <label for="title">Tire du rapport</label>
            <input type="text" class="form-control" placeholder="Donnez le titre du rapport" name="title" required>
        </div>
        <div class="form-group">
            <label for="date">Date du rapport</label>
            <input type="date" class="form-control" placeholder="Donnez la date du jour" name="date" required>
        </div>
        <div class="form-group">
            <label for="data[0]">Nombre 1</label>
            <input type="number" class="form-control" placeholder="Donnez le premier nombre" name="data[]" required>
        </div>
        <div class="form-group">
            <label for="data[1]">Nombre 2</label>
            <input type="number" class="form-control" placeholder="Donnez le deuxième nombre" name="data[]" required>
        </div>
    </div>

    <div class="alert alert-light clearfix">
        <div class="form-group">
            <label for="format">Format du rapport</label>
            <select name="format" id="format" class="form-control">
                <option value="html">HTML</option>
                <option value="json">JSON</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success float-right">Extraire le rapport</button>
        </div>
    </div>

</form>