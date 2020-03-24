<div class="row justify-content-md-center p-2">
    <form method="POST" class="col-12 col-md-6 align-self-center jumbotron p-4">
    <h1 class="text-center">Форма</h1>
    <div class="form-group">
      <input type="name" placeholder="Имя" name="name" class="form-control"><br>
      <input type="email" placeholder="Email" name="email" class="form-control"><br>
      <input type="number" placeholder="Год рождения" name="year" class="form-control"><br>
      </div>
      <h6>Пол</h6>
       <div class="form-group row col-6 justify-content-between">
      <div class="form-check">
      <label class="form-check-lable" for="gender">
        <input type="radio" value=0 name="gender" id="gender" class="form-check-input">
        М.
      </label>
      </div>
      <div class="form-check">
      <label class="form-check-lable" for="gender">
        <input type="radio" value=1 name="gender" id="gender" class="form-check-input">
        Ж.
      </label><br>
      </div>
      </div>
      <h6>Количество конечностей</h6>
      <div class="form-group row col-12 justify-content-between">
      	<div class="form-check">
      <input type="radio" value=1 name="bodyparts" class="form-check-input">
        <label for="one" class="form-check-label">1</label>
        </div>
        <div class="form-check">
      <input type="radio" value=2 name="bodyparts" class="form-check-input">
        <label for="two" class="form-check-label">2</label>
        </div>
        <div class="form-check">
      <input type="radio" value=3 name="bodyparts" class="form-check-input">
        <label for="three" class="form-check-label">3</label>
        </div>
        <div class="form-check">
      <input type="radio" value=4 name="bodyparts" class="form-check-input">
        <label for="four" class="form-check-label">4</label>
        </div>
        </div>
        <h6>Сверхспособности</h6>
        <div class="form-group">
      <select multiple name="powers[]" class="form-control">
        <option value=1>Бессмертие</option>
        <option value=2>Прохождение сквозь стены</option>
        <option value=3>Левитация</option>
      </select>
      <br>
      </div>
      <h6>Биография</h6>
      <div class="form-group">
      <textarea name="bio" class="form-control"></textarea>
      <br>
      <div class="form-check"
      <label for="agreed" class="form-check-label">
        <input type="checkbox" name="agreed" id="agreed" class="form-check-input" required>
        с контрактом ознакомлен
      </label>
      </div>
      <br>
      <input type="submit" value="Отправить" class="form-control">
      </div>
    </form>
</div>