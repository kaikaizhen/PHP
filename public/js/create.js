function call(){
    let site=document.getElementById('Site').value;
    let Lat=document.getElementById('Lat');
    let Lng=document.getElementById('Lng');


    axios.get(`https://nominatim.openstreetmap.org/search.php`,{
        params:{
            q:site,
            limit:1,
            format:'jsonv2'
        }
    })
    .then(res=>{
        data=res.data;
        Lat.value=data[0].boundingbox[0];
        Lng.value=data[0].boundingbox[2];
        document.getElementById('create').submit();
    })
    .catch(err=>{
        alert("找不到經緯度",err);
    });

}