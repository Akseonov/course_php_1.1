<form method="post">
    <input type="number" name="varA" size="10" value="<?=$_POST['varA']?>">
    <select type="text" name="operation">
        <option value="add" <?php if ($_POST['operation'] === 'add') echo 'selected'?>>+</option>
        <option value="sub" <?php if ($_POST['operation'] === 'sub') echo 'selected'?>>-</option>
        <option value="mul" <?php if ($_POST['operation'] === 'mul') echo 'selected'?>>*</option>
        <option value="div" <?php if ($_POST['operation'] === 'div') echo 'selected'?>>/</option>
    </select>
    <input type="number" name="varB" size="10" value="<?=$_POST['varB']?>">
    <input type="submit" value=" = ">
    <output name="result"><?=$strTask1?></output>
</form>