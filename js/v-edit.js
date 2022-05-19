document.addEventListener('DOMContentLoaded', async () => {
  const element   = document.getElementById('edit_view').dataset;
  const str_input = document.getElementById('str_input').value;
  const plugin_url = document.getElementById('plugin_url').value;

  console.log(plugin_url)

  const kintone = new kintone_api({
    exec_url: plugin_url+'kintone_api.php',
    domain  : element.domain,
    username: element.username,
    password: element.password
  });
  const app = kintone.app().get();

  console.log(app)

  const add_row_btn = document.getElementById('add_row');
  add_row_btn.addEventListener('click', () => {
    const trs = document.querySelector('#field-table tbody').getElementsByTagName('tr');
    add_row(trs.length);
  })
  
  const kintone_fields = {};
  document.getElementById('get_kintone').addEventListener('click', async () => {
    kintone_fields = {};


  });
  
}, false);


function inputChange(type, num) {
  console.log(type)
  console.log(num)
}

function add_row(n) {
  const tbody = document.querySelector('#field-table tbody');

  const row_base = [
    `<tr data-row=${n}>`,
    `<td style="vertical-align:middle;">${n + 1}</td>`,
    `<td><input type="text" oninput="inputChange('wp', ${n})" name="" value=""></td>`,
    `<td style="vertical-align:middle;"><span class="dashicons dashicons-controls-play"></span></td>`,
    `<td><input type="text" oninput="inputChange('kt', ${n})" name="" value=""></td>`,
    `<td style="display:flex;gap:5px;align-items:center;">`,
    `<button type="button" class="button-secondary">上に行を追加</button>`,
    `<button type="button" class="button-secondary">下に行を追加</button>`,
    `<button type="button" class="button-secondary">行を削除</button>`,
    `</td>`,
    `</tr>`,
  ].join('\n');
  tbody.innerHTML += row_base;
}


async function getKintoneByAppId(domain, username, password) {

}