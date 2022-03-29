const quiz=[
{question: 'コナンの持っている道具のひとつ「蝶ネクタイ型○○機」○○に入る言葉は？',answers:["変声","変装","変化","変更"],correct:"変声"},
{question: '工藤新一と毛利蘭の関係は？',answers:["いとこ","幼馴染","先輩後輩","兄妹"],correct:"幼馴染"},
{question: 'コナンの名セリフ「真実はいつも○○○」○○○に入る言葉は',answers:["ひとつ","ふたつ","みっつ","よっつ"],correct:"ひとつ"}
];
const quizLength=quiz.length;
let quizIndex=0;
let score=0;


const $button=document.getElementsByTagName('button');
const buttonLength=$button.length

const SetUpQuiz=()=>{
  document.getElementById('js-question').textContent=quiz[quizIndex].question;
  let buttonIndex=0;
  while(buttonIndex<buttonLength){
   $button[buttonIndex].textContent=quiz[quizIndex].answers[buttonIndex];
    buttonIndex++;
  }
}
SetUpQuiz();

const clickHandler=(e)=>{
  if(quiz[quizIndex].correct===e.target.textContent){
    window.alert("正解");
    score++;
  }else{
    window.alert("不正解");
  }
  quizIndex++;
  if(quizIndex<quizLength){
    SetUpQuiz();
  }else{
    window.alert("正解数は"+score+'/'+quizLength);
  }
};



//  $button[0].textContent=answers[0];
//  $button[1].textContent=answers[1];
//  $button[2].textContent=answers[2];
//  $button[3].textContent=answers[3];
let handleIndex=0;

while (handleIndex<buttonLength) {
  $button[handleIndex].addEventListener('click',(e)=>{
    clickHandler(e);
    });
    handleIndex++;
}

