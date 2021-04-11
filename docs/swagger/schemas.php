<?php

#-------------------------------------------------------------------------------
############################## DefaultErrorResponse ##############################
#-------------------------------------------------------------------------------

/**
 * @OA\Schema(
 *   schema="DefaultErrorResponse",
 *   title="DefaultErrorResponse",
 *   @OA\Property(property="message", type="string", description="Mensagem com detalhe do erro.")
 * )
 */


#-------------------------------------------------------------------------------
############################## Recruiter ##############################
#-------------------------------------------------------------------------------

/**
 * @OA\Schema(
 *   schema="Recruiter",
 *   title="Recruiter",
 *   required={"email", "name", "password", "company_id"},
 *   @OA\Property(property="id", type="string", description="ID universal. Atributo apenas para leitura."),
 *   @OA\Property(property="name", type="string", description="Nome."),
 *   @OA\Property(property="password", type="string", description="Senha de acesso. Atributo usado somente ao criar um recrutador"),
 *   @OA\Property(property="email", type="string", description="Endereço de e-mail."),
 *   @OA\Property(property="company_id", type="string", description="UUID da companhia vinculada ao recrutador.")
 * )
 */


#-------------------------------------------------------------------------------
############################## Company ##############################
#-------------------------------------------------------------------------------

/**
 * @OA\Schema(
 *   schema="Company",
 *   title="Company",
 *   required={"id", "name"},
 *   @OA\Property(property="id", type="string", description="ID universal. Atributo apenas para leitura."),
 *   @OA\Property(property="name", type="string", description="Nome.")
 * )
 */


#-------------------------------------------------------------------------------
############################## Opportunity ##############################
#-------------------------------------------------------------------------------

/**
 * @OA\Schema(
 *   schema="Opportunity",
 *   title="Opportunity",
 *   required={"id", "name", "address", "salary", "status", "description"},
 *   @OA\Property(property="id", type="string", description="ID universal. Atributo apenas para leitura."),
 *   @OA\Property(property="title", type="string", description="Título."),
 *   @OA\Property(property="description", type="string", description="Descrição."),
 *   @OA\Property(property="status", type="string", description="Status. valores aceitos: opened, finished e inactive"),
 *   @OA\Property(property="salary", type="number", description="Salário com duas casas decimais e separados por ponto. Exemplo: 5500.00"),
 *   @OA\Property(property="address", type="string", description="Endereço."),
 *   @OA\Property(property="company", ref="#/components/schemas/Company"),
 *   @OA\Property(property="recruiter", ref="#/components/schemas/Recruiter")
 * )
 */


#-------------------------------------------------------------------------------
############################## Login ##############################
#-------------------------------------------------------------------------------

/**
 * @OA\Schema(
 *   schema="Login",
 *   title="Autenticação",
 *   required={"email", "password"},
 *   @OA\Property(property="email", type="string", description="E-mail."),
 *   @OA\Property(property="password", type="string", description="Senha de acesso."),
 *
 * )
 */

/**
 * @OA\Schema(
 *   schema="LoginResult",
 *   title="Login - Resposta",
 *   @OA\Property(
 *      property="account",
 *      description="Dados da conta",
 *      allOf={
 *          @OA\Schema(
 *              @OA\Property(property="name", type="string", description="Nome do titular da conta."),
 *              @OA\Property(property="email", type="string", description="E-mail do titular da conta.")
 *          )
 *      }
 *   ),
 *   @OA\Property(property="token", type="string", description="Token de acesso")
 * )
 */



/**
 * @OA\Schema(
 *   schema="TransferenciaCriada",
 *   title="Transferência Criada",
 *   @OA\Property(property="id", type="string", description="Id da operação."),
 *   @OA\Property(property="value", type="number", description="valor da operação."),
 *   @OA\Property(property="created_at", type="string", description="Data hora da operação."),
 *   @OA\Property(
 *      property="payer",
 *      description="Conta pagadora.",
 *      allOf={
 *          @OA\Schema(
 *              @OA\Property(property="id", type="string", description="ID da conta."),
 *              @OA\Property(property="name", type="string", description="Nome do titular da conta."),
 *              @OA\Property(property="email", type="string", description="E-mail do titular da conta.")
 *          )
 *      }
 *   ),
 *
 *   @OA\Property(
 *      property="payee",
 *      description="Conta favorecida.",
 *      allOf={
 *          @OA\Schema(
 *              @OA\Property(property="id", type="string", description="ID da conta."),
 *              @OA\Property(property="name", type="string", description="Nome do titular da conta."),
 *              @OA\Property(property="email", type="string", description="E-mail do titular da conta.")
 *          )
 *      }
 *   )
 * )
 */
