//file save in databse with base 64 format

if ($request->hasFile('pic'))
{
    $file = $request->file('pic');
    $filename = time() . '-' . $file->getClientOriginalName();
    $path=$file->move('rob/', $filename);
    $logo = file_get_contents($path);
    $base64 = base64_encode($logo);
}

// <img src="data:image/png;base64,iVBORw0KGgoAAA
// ANSUhEUgAAAAUAAAAFCAYAAACNbyblAAAAHElEQVQI12P4
// //8/w38GIAXDIBKE0DHxgljNBAAO9TXL0Y4OHwAAAABJRU
// 5ErkJggg==" alt="Red dot" />
