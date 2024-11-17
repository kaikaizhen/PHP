let data;
document.addEventListener('DOMContentLoaded', function() {
    axios.get('/api/GetLog')
        .then(res=>{
            data=res.data;
            console.log(data);

            
            Data(data);
        })
        .catch(err=>{
            console.log('err',err);
        })
})

function Data(data){
    let content=document.getElementById('content');
    content.innerHTML='';
    if(data.length==0){
        content.innerHTML='目前沒有資料';
    }
    for(let item of data){
        let div=document.createElement('div');
        div.className="log";
        div.setAttribute('onclick',`window.location.href="/LogShow?id=${item.id}"`);
        div.innerHTML=`

        <image class="img" src="${item.image_url}" alt="圖片無法載入">
        <h1>${item.Title}</h1>
        <p>${item.description}</p>
        <span>${item.Date}</span>

        `;
        content.append(div);
    }
}

function filter(){
    let f=document.getElementById('filter').value;
    filterdata=data.filter(item=>item.Type.includes(f))
    Data(filterdata);
}