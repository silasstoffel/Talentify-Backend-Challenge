<?php

####### Auth #######
/**
 * @OA\Post(
 *     path="/auth",
 *     summary="Efetua autenticação",
 *     description="Efetua autenticação da sua conta na plataforma YouPay.",
 *     tags={"Auth"},
 *     @OA\RequestBody(
 *         description="Auth",
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Login")
 *     ),
 *     @OA\Response(
 *       response="200",
 *       description="Autenticação efetuada com sucesso.",
 *       @OA\JsonContent(ref="#/components/schemas/LoginResult")
 *     ),
 *     @OA\Response(
 *       response="401",
 *       description="Sem autorização.",
 *       @OA\JsonContent(ref="#/components/schemas/DefaultErrorResponse")
 *     ),
 *     @OA\Response(
 *       response="400",
 *       description="Detalhamento do erro.",
 *       @OA\JsonContent(ref="#/components/schemas/DefaultErrorResponse")
 *     )
 * )
 */

#### Recruiter ####

/**
 * @OA\Post(
 *     path="/recruiters",
 *     summary="Cadastro de recrutador",
 *     description="Cadastra um recrutador.",
 *     tags={"Recruiters"},
 *     @OA\RequestBody(
 *         description="Cadastra um recrutador",
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Recruiter")
 *     ),
 *     @OA\Response(
 *       response="201",
 *       description="Cadastro efetivadao com sucesso.",
 *     ),
 *     @OA\Response(
 *       response="401",
 *       description="Sem autorização.",
 *       @OA\JsonContent(ref="#/components/schemas/DefaultErrorResponse")
 *     ),
 *     @OA\Response(
 *       response="400",
 *       description="Detalhamento do erro.",
 *       @OA\JsonContent(ref="#/components/schemas/DefaultErrorResponse")
 *     )
 * )
 */


#### Opportunities ####

/**
 * @OA\Post(
 *     path="/v1/opportunities",
 *     summary="Cadastra de vagas.",
 *     description="Cadastra uma vaga. Os atributos company:{} e recruiter:{} não precisam ser preenchidos no cadastro nem na atualização.",
 *     tags={"Opportunities"},
 *     security={{"Token": {}}},
 *     @OA\RequestBody(
 *         description="Cadastra uma oportunidade",
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Opportunity")
 *     ),
 *     @OA\Response(
 *       response="201",
 *       description="Oportunidade criada com sucesso.",
 *     ),
 *     @OA\Response(
 *       response="401",
 *       description="Sem autorização.",
 *       @OA\JsonContent(ref="#/components/schemas/DefaultErrorResponse")
 *     ),
 *     @OA\Response(
 *       response="400",
 *       description="Detalhamento do erro.",
 *       @OA\JsonContent(ref="#/components/schemas/DefaultErrorResponse")
 *     )
 * )
 */

/**
 * @OA\Put(
 *     path="/v1/opportunities/{opportunity_id}",
 *     summary="Atualização de vagas.",
 *     description="Atualiza uma vaga. Os atributos company:{} e recruiter:{} não precisam ser preenchidos no cadastro nem na atualização.",
 *     tags={"Opportunities"},
 *     security={{"Token": {}}},
 *     @OA\Parameter(
 *         description="ID da Vaga",
 *         in="path",
 *         name="opportunity_id",
 *         required=true,
 *         @OA\Schema(
 *           type="string"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         description="Atualiza uma oportunidade",
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/Opportunity")
 *     ),
 *     @OA\Response(
 *       response="200",
 *       description="Oportunidade atualizada com sucesso.",
 *     ),
 *     @OA\Response(
 *       response="401",
 *       description="Sem autorização.",
 *       @OA\JsonContent(ref="#/components/schemas/DefaultErrorResponse")
 *     ),
 *     @OA\Response(
 *       response="400",
 *       description="Detalhamento do erro.",
 *       @OA\JsonContent(ref="#/components/schemas/DefaultErrorResponse")
 *     )
 * )
 */

/**
 * @OA\Get(
 *     path="/v1/opportunities/{opportunity_id}",
 *     summary="Ler uma vaga pelo ID.",
 *     description="Lê uma vaga pelo ID",
 *     tags={"Opportunities"},
 *     security={{"Token": {}}},
 *     @OA\Parameter(
 *         description="ID da Vaga",
 *         in="path",
 *         name="opportunity_id",
 *         required=true,
 *         @OA\Schema(
 *           type="string"
 *         )
 *     ),
 *     @OA\Response(
 *       response="200",
 *       description="Oportunidade encontrada com sucesso.",
 *       @OA\JsonContent(ref="#/components/schemas/Opportunity")
 *     ),
 *     @OA\Response(
 *       response="401",
 *       description="Sem autorização.",
 *       @OA\JsonContent(ref="#/components/schemas/DefaultErrorResponse")
 *     ),
 *     @OA\Response(
 *       response="400",
 *       description="Detalhamento do erro.",
 *       @OA\JsonContent(ref="#/components/schemas/DefaultErrorResponse")
 *     )
 * )
 */

/**
 * @OA\Get(
 *     path="/v1/opportunities",
 *     summary="Ler todas oportunidades.",
 *     description="Carrega todas opportunidades acessada pelo recrutador.",
 *     tags={"Opportunities"},
 *     security={{"Token": {}}},
 *     @OA\Response(
 *       response="200",
 *       description="Oportunidades permitidas para recurtador em acesso.",
 *       @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Opportunity"))
 *     ),
 *     @OA\Response(
 *       response="401",
 *       description="Sem autorização.",
 *       @OA\JsonContent(ref="#/components/schemas/DefaultErrorResponse")
 *     ),
 *     @OA\Response(
 *       response="400",
 *       description="Detalhamento do erro.",
 *       @OA\JsonContent(ref="#/components/schemas/DefaultErrorResponse")
 *     )
 * )
 */

/**
 * @OA\Delete(
 *     path="/v1/opportunities/{opportunity_id}",
 *     summary="Delete uma vaga.",
 *     description="Delete uma vaga pelo ID.",
 *     tags={"Opportunities"},
 *     security={{"Token": {}}},
 *     @OA\Parameter(
 *         description="ID da Vaga",
 *         in="path",
 *         name="opportunity_id",
 *         required=true,
 *         @OA\Schema(
 *           type="string"
 *         )
 *     ),
 *     @OA\Response(
 *       response="204",
 *       description="Oportunidade excluida com sucesso.",
 *     ),
 *     @OA\Response(
 *       response="401",
 *       description="Sem autorização.",
 *       @OA\JsonContent(ref="#/components/schemas/DefaultErrorResponse")
 *     ),
 *     @OA\Response(
 *       response="400",
 *       description="Detalhamento do erro.",
 *       @OA\JsonContent(ref="#/components/schemas/DefaultErrorResponse")
 *     )
 * )
 */

#### Jobs ####

/**
 * @OA\Get(
 *     path="/jobs",
 *     summary="Filtragem de vagas em aberto.",
 *     description="Filtra as vagas de trabalho em aberto.",
 *     tags={"Jobs"},
 *
 *     @OA\Parameter(
 *          name="keyword",
 *          description="Busca livre",
 *          in="query",
 *          @OA\Schema(type="string")
 *     ),
 *
 *     @OA\Parameter(
 *          name="address",
 *          description="Endereço",
 *          in="query",
 *          @OA\Schema(type="string")
 *     ),
 *
 *     @OA\Parameter(
 *          name="salary",
 *          description="Salário",
 *          in="query",
 *          @OA\Schema(type="number")
 *     ),
 *
 *     @OA\Parameter(
 *          name="company",
 *          description="company",
 *          in="query",
 *          @OA\Schema(type="string")
 *     ),
 *
 *     @OA\Response(
 *       response="200",
 *       description="Vagas filtradas.",
 *       @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Opportunity"))
 *     ),
 *
 *     @OA\Response(
 *       response="400",
 *       description="Detalhamento do erro.",
 *       @OA\JsonContent(ref="#/components/schemas/DefaultErrorResponse")
 *     )
 * )
 */
