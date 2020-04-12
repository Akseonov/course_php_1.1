<form method="post">
    <input type="number" name="varA" size="10" value="<?=$_POST['varA']?>">
    <input type="submit" name="operation" value="add">
    <input type="submit" name="operation" value="sub">
    <input type="submit" name="operation" value="mul">
    <input type="submit" name="operation" value="div">
    <input type="number" name="varB" size="10" value="<?=$_POST['varB']?>">
    <output name="result"> = <?=$strTask2?></output>
</form>