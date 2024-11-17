document.addEventListener('DOMContentLoaded', function() {
    const urlParams=new URLSearchParams(window.location.search);
    const id=urlParams.get('id');

    if(id){
        axios.get(`/api/GetLogItem/${id}`)
            .then(res=>{
                let data=res.data;

                let div=document.getElementById('log');
            let height=0;
            let i=true;
            let h=500;
            for(let item of data){
                let Line=document.getElementById('Line');
                Line.style.height=h+"px";
                let content=document.createElement('div');
                content.className='log_content';
                content.style.top=height+'%';
                if(i){
                    content.style.left='5%';
                }else{
                    content.style.right='2%';
                }
                content.innerHTML=`
                    
                        <div class="log_title">${item.Title}</div>
                            <div class="log_body">
                                <img class="log_image" src="${item.image_url}" alt="描述文字">
                            <div class="log_text">
                                ${item.description}
                            </div>
                        </div>
                    
                `;

                div.append(content);
                height+=25;
                i=!i;
                h+=180;
            }
            })
            .catch(err=>{
                console.log('err',err);
            })
    }
})