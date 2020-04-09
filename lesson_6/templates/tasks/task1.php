<form method="post">
    <input type="text" name="varA" size="10" value="0">
    <select type="text" name="operation">
        <option value="add" >+</option>
        <option value="sub">-</option>
        <option value="mul">*</option>
        <option value="div">/</option>
    </select>
    <input type="text" name="varB" size="10" value="0">
    <input type="button" value=" = ">
    <output name="result"><?=$result?></output>
</form>