


Instalação:
 - Inicie seu servidor localhost.
 - Configure os acessos do seu banco de dados no arquivo .env.
 - Crie a tabela chamada monitoramento_de_ramais.
 - Abra o arquivo ramais.sql e execute no seu banco todas as querys uma a uma
 - Sua aplicação já está pronta.

 Melhorias
 - Implementação de um novo código de legível e com manuterabildade no lado do backend, visando alterações futuras.
 - Criação de arquivo App para ser o gerenciador de requisições
 - Ajuste no layout baseado em uma melhor visibilidade para o usuário, respeitando as melhores regras de contraste.
 - Colocando as acessos do banco em um local seguro, sem ficarem expostas.


 Notas:
 - Em filas, quando o status está como (paused) (Not in use) o código prioriza (paused). mas se houver apenas (Not in use) ficará como disponível.
 - Como se trata de um teste, a operação de Deletar no banco de dados, apaga os registros no banco definitivamente.
 
 O sistema funciona da seguinte forma:
 - O cliente faz uma requisição Ajax a cada 10 segundos para o servidor através da action obterDados em app.
 - No backend em App a gente poderia simular várias requisições A classe informações é a responsável por iniciar e obter os dados do banco de dados.
 - ramais.php é responsável pela leitura dos arquivos de filas e ramais, também organizando e sempre no final mesclando os dados dos arquivos com o banco de   dados a função principal do banco de dados é mesclarDadosNoBanco() e ele vai comparar os com os dados dos ramais organizados de ramais.php com os dados do banco o critério que ajuda na comparação é o name (ramal). 
- Se o ramal inserido no arquivo já possui no banco a funcao dele é atualizar, se não possuir ele insere, e se ele não enviar mais o ramal, ele entende que não possui mais e vai deletar do banco.